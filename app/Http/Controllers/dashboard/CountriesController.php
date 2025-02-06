<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class CountriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $showallcountries = Countries::latest()->get();
        $country_names = Countries::select('id', 'country_name','href' , 'country_flag')->get();
        return view('dash-board.countries.allcountry', compact('country_names','showallcountries'));
    }
    public function getCitiesWithCountry($count_id){
        $countROW = 12;
        $country_namess = Countries::select('id', 'country_name', 'country_flag' , 'href')->where('id' , $count_id)->first();
        $cities_show = City::with('country')->where('country_id' ,$count_id)->latest()->paginate($countROW);
        $country_names = Countries::select('id', 'country_name','href' , 'country_flag')->get();
        
        return view('dash-board.countries.allcountry' , compact('cities_show','country_names','country_namess'));
        
    }


    public function create()
    {
        return view('dash-board.countries.createcountry');
    }


    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'country_name'  => 'required',
            'href'          => 'required',
            'title'         => 'required'
        ]);
        if($request->show_status){
            $countries_status = DB::table('countries')->select('show_status')->update(['show_status'=> 0]);
            if($request->country_flag){
                $time=time();
                $image = Image::make($request->file('country_flag')->getRealPath())->encode('webp', 100)->resize(16, 16)->save(public_path('uploading/'  .  $time . '.webp'));
                $newImageName = time(). '.' . $request->country_flag->extension();
            }else{
                $time=Null;
            }


            $datacountry = Countries::create([
                'country_name'      => $request->input('country_name'),
                'href'              => $request->input('href'),
                'country_flag'      => $time . '.' . 'webp',
                // 'show_status'    => $request->input('show_status'),
                'title'             => $request->input('title'),
                'keyword'             => $request->input('keyword'),
                'meta_descr'        => $request->input('meta_descr'),
            ]);
        }
        else{

            if($request->country_flag){
                $time=time();
                $image = Image::make($request->file('country_flag')->getRealPath())->encode('webp', 100)->resize(16, 11)->save(public_path('uploading/'  .  $time . '.webp'));
                $newImageName = time(). '.' . $request->country_flag->extension();
            }else{
                $time=Null;
            }
            $request->show_status == 0;
            $datacountry = Countries::create([
                'country_name'      => $request->input('country_name'),
                'href'              => $request->input('href'),
                'country_flag'      => $time . '.' . 'webp',
                // 'show_status'       => $request->show_status,
                'title'             => $request->input('title'),
                'meta_descr'        => $request->input('meta_descr'),
            ]);
        }



        // dd($datacountry);
        return  redirect()->route('countries.main')
            ->with('success', 'Successfuly Added Country');
    }


    public function edit(Countries $countries, $id)
    {
        $countries = Countries::find($id);
        return view('dash-board.countries.editcountry', compact('countries'));
    }

    public function update(Request $request, Countries $countries, $id)
    {
        $countries = Countries::find($id);

        $request->validate([
            'country_name'  => 'required',
            'href'          => 'required',
            // 'country_flag'  => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:2048|dimensions:max_width=600,max_height=600',
            'title'         => 'required'
        ]);
        

        if($request->country_flag){
            $pathImg = str_replace('\\', '/', public_path('uploading/')) . $countries->country_flag;
            if (File::exists($pathImg)) {
                File::delete($pathImg);
            }
            $time=time();
            Image::make($request->file('country_flag')->getRealPath())->encode('webp', 100)->resize(16, 11)->save(public_path('uploading/'  .  $time . '.webp'));
            DB::table('countries')->where('id' , $id)->update([
                'country_flag' => $time . '.' . 'webp',
            ]);

        }
        // else{
        //     $time = Null;
        //     DB::table('countries')->where('id' , $id)->update([
        //         'country_flag' => $time . '.' . 'webp',
        //     ]);
        // }

        // $countries->show_status = $request->show_status ? DB::table('countries')->select('show_status')->update(['show_status'=> 0]) : DB::table('countries')->select('show_status')->update(['show_status'=> 1]);
        $countries->country_name = $request->country_name;
        $countries->href         = $request->href;
        $countries->title        = $request->title;
        $countries->keyword        = $request->keyword;
        $countries->meta_descr   = $request->meta_descr;
        $countries->update();

        return  redirect()->route('countries.main')
            ->with('success', 'Successfuly Added Country');
    }

    public function destroy(Countries $countries, $id)
    {
        $countries = Countries::find($id);

        $destination = str_replace('\\', '/', public_path('uploading/')) . $countries->country_flag;
        
        if (File::exists($destination)) {
            File::delete($destination);
            $countries->delete();
            return redirect()->route('countries.main')
                ->with('success', 'deleted data');
        }
        $countries->delete();
        return redirect()->route('countries.main')
            ->with('success', 'deleted data');
    }
}
