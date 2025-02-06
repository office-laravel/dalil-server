<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Countries;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $cities = City::all();
        $country = Countries::get();
        return view('dash-board.cities.index', compact('cities', 'country'));
    }


    public function create()
    {
        $country = Countries::get();
        return view('dash-board.cities.create', compact('country'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'name'      =>'required',
            'href'      => 'required'
        ]);
        
        
        City::create([
            'country_id' => $request->country_id,
            'name'       => $request->name,
            'href'       => $request->href,
            // 'description'=> $request->description,
        ]);
        


        return redirect()->route('city.all')->with('msg', 'تم اضافة مدينة بنجاح');

    }




    public function edit($id)
    {
        $cities = City::find($id);
        $country = Countries::get();
        return view('dash-board.cities.edit', compact('country', 'cities'));
    }


    public function update(Request $request, $id)
    {
        $cities = City::find($id);
        
        
        $cities->country_id = $request->country_id;
        $cities->name = $request->name;
        $cities->href = $request->href;
        // $cities->description = $request->description;
        $cities->update();



        return redirect()->route('city.all')->with('msg', 'تم تحديث مدينة بنجاح');
    }


    public function destroy($id)
    {
        $cities = City::find($id);
        
        $cities->delete();

        return redirect()->route('city.all')->with('msg', 'تم حذف مدينة بنجاح');
    }
}
