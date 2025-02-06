<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\PinnedPages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\sitting;

class PinnedPagesController extends Controller
{
    //  for secure
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $getAllPinnedPage = PinnedPages::latest()->get();
        $DataSittings=sitting::where("id",1)->first();
        return view('dash-board.PinnedPage.AllpinnedPage' , compact(['getAllPinnedPage','DataSittings']));
    }


    public function create(){
        $DataSittings=sitting::where("id",1)->first();
        $countries =  Countries::all();
        return view('dash-board.PinnedPage.create',compact('countries','DataSittings'));
    }

// |image|mimes:png,jpg,jpeg,svg,gif|max:2048|dimensions:min_width=256,min_height=300,max_width=720,max_height=920', /* required|image|mimes:png,jpg,jpeg,svg,gif|max:2048 */
    public function store(Request $request)
    {

        $request->validate([
            'page_name'     => 'required',
            'href'          => 'required|unique:pinned_pages,href',
            'keyword'       => 'required',
            'content'       => 'required'
            // 'photo'         => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:2048|dimensions:max_width=720,max_height=920'
        ]);

        if($request->hasFile('photo')){
            $newImageName = time(). '.' . $request->photo->extension();
            $request->photo->move(public_path('uploading/') , $newImageName);
        }


        $mydata=PinnedPages::create([
            'page_name'  => $request->input('page_name'),
            'href'       => $request->input('href'),
            'title'      => $request->input('title'),
            'keyword'    => $request->input('keyword'),
            'content'    => $request->input('content')

            // 'photo'      => $newImageName
        ]);

        return redirect()->route('createPage')
        ->with('success', 'added data');
    }





    public function edit(PinnedPages $pinnedPages , $id)
    {
        $findId = PinnedPages::find($id);
        $countries =  Countries::all();
        return view('dash-board.PinnedPage.editPage' , compact('countries','findId'));
    }


    public function update(Request $request, PinnedPages $pinnedPages ,$id)
    {
        $findId = PinnedPages::find($id);
        $request->validate([
            'page_name'     => 'required',
            'href'          => 'required',
            'keyword'       => 'required',
            'content'       => 'required'
            // 'photo'         => 'required|image|mimes:png,jpg,jpeg,svg,gif|max:2048|dimensions:max_width=720,max_height=920'
        ]);
        if($request->hasFile('photo')){
            $pathImg = str_replace('\\' , '/' ,public_path('uploading/')).$findId->photo;

            if(File::exists($pathImg)){
                File::delete($pathImg);
            }
            $newImageName = time() .'.'. $request->photo->extension();
            $request->photo->move(public_path('uploading/') , $newImageName);
        }

            $findId->page_name = $request->page_name;
            $findId->href      = $request->href;
            $findId->title      = $request->title;
            $findId->keyword   = $request->keyword;
            $findId->content   = $request->content;
            // $findId->photo     = $newImageName;
            $findId->update();

        return redirect()->route('main.pages')
            ->with('success' , 'Successfully updated Data');
    }


    public function destroy(PinnedPages $pinnedPages , $id)
    {
        $findId = PinnedPages::find($id);
        $destination =  str_replace('\\' , '/' ,public_path('uploading/')).$findId->photo;
        if(File::exists($destination)){
            File::delete($destination);
            $findId->delete();
            return  redirect()->route('main.pages')
                ->with('success' , 'Successfully Deleted Data');
        }
        $findId->delete();
        return  redirect()->route('main.pages')
            ->with('success' , 'Successfully Deleted Data');
    }
}
