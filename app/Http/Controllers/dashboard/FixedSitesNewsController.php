<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\FixedSiteNews;

class FixedSitesNewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
   
    public function index()
    {
        $fixedsitestnews = FixedSiteNews::all();
        
        return view('dash-board.SitesFixedNews.index', compact('fixedsitestnews'));

    }

    
    public function create()
    {
        return view('dash-board.SitesFixedNews.create');
    }

    
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'  => 'required',
            'href'  => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], 
        [
        'image.required' => 'الرجاء تحميل ملف صورة',
        'image.image' => 'يجب أن يكون الملف صورة',
        'image.mimes' => 'يجب أن يكون الملف بتنسيق JPG أو PNG',
        'image.max' => 'يجب أن يكون حجم الملف أقل من 2 ميغا بايت',
        ]);
        
        if($request->photo){
            $time=time();
            $image = Image::make($request->file('photo')->getRealPath())->encode('webp', 100)->resize(50, 50)->save(public_path('uploading/'  .  $time . '.webp'));
            // $newImageName = time(). '.' . $request->photo->extension();
        
            DB::table('fixed_sites_news')->insert([
                'name' => $request->name,
                'link' => $request->href,
                'img' => $time . '.' . 'webp',
            ]);
        }else{
            $time=Null;
            
            DB::table('fixed_sites_news')->insert([
                'name' => $request->name,
                'link' => $request->href,
                'img' => $time,
            ]);
        }
    
        return redirect()->route('fixedsitesnews.main')
                ->with('success' , 'تم اضافة البيانات بنجاح');
        
    }

    
    // public function show($id)
    // {
    //     //
    // }

    
    public function edit($id)
    {
        $fixedsitestnews = FixedSiteNews::find($id);
        return view('dash-board.SitesFixedNews.edit', compact('fixedsitestnews'));
        
    }

    
    public function update(Request $request, $id)
    {
        $fixedsitestnews = FixedSiteNews::find($id);
        
        if($request->photo){
            $pathImg = str_replace('\\' , '/' ,public_path('uploading/')).$fixedsitestnews->photo;
            if(File::exists($pathImg)){
                File::delete($pathImg);
            }
            $time=time();
            $image = Image::make($request->file('photo')->getRealPath())->encode('webp', 100)->resize(50, 50)->save(public_path('uploading/'  .  $time . '.webp'));
        
            DB::table('fixed_sites_news')->where('id', $id)->update([
                'img' => $time . '.' . 'webp',
            ]);
        }
            
            DB::table('fixed_sites_news')->where('id', $id)->update([
                'name' => $request->name,
                'link' => $request->href,
            ]);
        
    
        return redirect()->route('fixedsitesnews.main')
                ->with('success' , 'تم تحديث البيانات بنجاح');
    }

    
    public function destroy($id)
    {
        $fixedsitestnews = FixedSiteNews::find($id);
        $pathImg = str_replace('\\' , '/' ,public_path('uploading/')).$fixedsitestnews->photo;
        if(File::exists($pathImg)){
            File::delete($pathImg);
        }
            
        $fixedsitestnews->delete();    
        
        return redirect()->route('fixedsitesnews.main')
                ->with('success' , 'تم حذف بنجاح');
    }
}
