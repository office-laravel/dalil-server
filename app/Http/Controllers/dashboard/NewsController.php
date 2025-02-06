<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
// use Image;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    
    public function index()
    {
        $news = News::latest()->get();
        return view('dash-board.news.index', compact('news'));
    }

   
    public function create()
    {
        return view('dash-board.news.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        // Upload two picture at the same time
        if ($request->image){
            $time1 = time();
            $time2 = time();
            $img1= Image::make($request->image->getRealPath())->encode('webp', 100)->resize(900, 533)->save(public_path('newsImage/' .  $time1. '.webp'));
            $img2= Image::make($request->image->getRealPath())->encode('webp', 100)->resize(270, 160)->save(public_path('smallNewsImage/' .  $time2 . '.webp'));
            $photos = [$time1 . '.webp', $time2 . '.webp'];
            $convert = implode(",", $photos);
            // dd($photos);
            DB::table('news')->insert([
                'title'  => $request->title,
                'descr'  => $request->descr,
                'image' => $convert,
            ]);
            
        }
        else{
            $timesh = null;
            
            DB::table('news')->insert([
                'title'  => $request->title,
                'descr'  => $request->descr,
                'image' => $timesh,
            ]);
        }
        
        
        return redirect()->route('news.main')->with('success', 'تم اضافة الخبر بنجاح');
    }

    
    public function edit($id)
    {
        $news = News::find($id);
        return view('dash-board.news.edit', compact('news'));
    }

    
    public function update(Request $request, $id)
    {
        $news = News::find($id);
        
        if($request->hasFile('image')){
            // if(File::exists($pathImg)){
            //     File::delete($pathImg);
            // }
            $getIMG = News::where('id', $id)->select('id','image')->first();
            $get_Pictrue = array(explode (",", $getIMG ->image));
            foreach ($get_Pictrue as $index => $val) {
                if (isset($val[0])) {
                    $pathImg1 = str_replace('\\', '/', public_path('newsImage/')) . $val[0];
                    if (File::exists($pathImg1)) {
                        File::delete($pathImg1);
                    }
                }
                
                if (isset($val[1])) {
                    $pathImg2 = str_replace('\\', '/', public_path('smallNewsImage/')) . $val[1];
                    if (File::exists($pathImg2)) {
                        File::delete($pathImg2);
                    }
                }
            }
            $time1 = time();
            $time2 = time();
            $img1= Image::make($request->image->getRealPath())->encode('webp', 100)->resize(900, 533)->save(public_path('newsImage/' .  $time1. '.webp'));
            $img2= Image::make($request->image->getRealPath())->encode('webp', 100)->resize(270, 160)->save(public_path('smallNewsImage/' .  $time2 . '.webp'));
            $photos = [$time1 . '.webp', $time2 . '.webp'];
            $convert = implode(",", $photos);
            DB::table('news')->where('id', $news->id)->update([
                'image' => $convert,
            ]);
        }
        
        DB::table('news')->where('id', $news->id)->update([
            'title'  => $request->title,
            'descr'  => $request->descr,
        ]);
        
        return redirect()->route('news.main')->with('success', 'تم تحديث الخبر بنجاح');
    }

   
    public function destroy($id)
    {
        $news = News::find($id);
        $getIMG = News::where('id', $id)->select('id','image')->first();
        $get_Pictrue = array(explode (",", $getIMG ->image));
        
        foreach($get_Pictrue as $index => $val){
            $pathImg1 =  str_replace('\\' , '/' , public_path('newsImage/')) . $val[0];
            if(File::exists($pathImg1 )){
                File::delete($pathImg1 );
            }
            
            $pathImg2 =  str_replace('\\' , '/' , public_path('smallNewsImage/')) . $val[1];
            if(File::exists($pathImg2 )){
                File::delete($pathImg2 );
            }
            
        }
        $news->delete();
        return redirect()->route('news.main')->with('success', 'تم حذف الخبر بنجاح');
    }
}
