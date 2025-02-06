<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\sitting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;


class sittingController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function getSetting()
    {
        $getShowSettings = sitting::first();
        // dd($getShowSettings);

        return view('dash-board.sittings', compact('getShowSettings'));
    }


    public function setSittings(Request $request)
    {
        
        $validation = $request->validate([
            'nameWebsite' => "max:30",
            'Description' => "max:256"
        ]);
        $get_id = sitting::select('id','favicon')->first();
        $pathImg = str_replace('\\', '/', public_path('uploading/')) . $get_id->favicon;
        if (sitting::select('id')->exists()) {
            
            
            if($request->hasFile('favicon')){
                $get_id = sitting::select('id', 'favicon')->first();
                $pathImg = str_replace('\\', '/', public_path('uploading/')) . $get_id->favicon;
                if (File::exists($pathImg)) {
                    File::delete($pathImg);
                }
                $image = $request->file('favicon');
                $name = hexdec(uniqid());
                $real_path = './public/uploading/';
                Image::make($image->getRealPath())->encode('webp', 100)->resize(150, 150)->save(public_path('uploading/'  .  $name . '.webp'));
                DB::table('sittings')->where('id' , $get_id->id)->update([
                    'favicon' => $name . '.' . 'webp'
                ]);
            }
            if($request->hasFile('imgDefault')){
                $get_id = sitting::select('id', 'image_default')->first();
                $pathImg = str_replace('\\', '/', public_path('uploading/')) . $get_id->image_default;
                if (File::exists($pathImg)) {
                    File::delete($pathImg);
                }
                $image = $request->file('imgDefault');
                $name = hexdec(uniqid());
                $real_path = './public/uploading/';
                Image::make($image->getRealPath())->encode('webp', 100)->resize(228, 170)->save(public_path('uploading/'  .  $name . '.webp'));
                DB::table('sittings')->where('id' , $get_id->id)->update([
                    'image_default' => $name . '.' . 'webp'
                ]);
            }
            
            $insertTODatabase = DB::table('sittings')->update([
                'nameWebsite' => $request->nameWebsite,
                'linkWebsite' => $request->linkWebsite,
                'Description' => $request->Description,
                'socialMidiaFacebook' => $request->socialMidiaFacebook,
                'socialMidiaTelegram' => $request->socialMidiaTelegram,
                'socialMidiaInstagram' => $request->socialMidiaInstagram,
                'socialMidiaYoutube' => $request->socialMidiaYoutube,
                'Keywords' => $request->Keywords,
                'insertQuick' => $request->insertCheck ? true : false ,
                'Is_hide' => $request->btnhide ? true : false,
                
            ]);

            return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
        } else {
            
            if ($request->hasFile('favicon')) {
                $myimage = $request->input('favicon');
                $time = time();
                Image::make($request->file('favicon')->getRealPath())->encode('webp', 100)->resize(150, 150)->save(public_path('uploading/' .  $time . '.webp'));
            }
            if ($request->hasFile('imgDefault')) {
                $myimage = $request->input('imgDefault');
                $timeImgDefault = time();
                Image::make($request->file('imgDefault')->getRealPath())->encode('webp', 100)->resize(228, 170)->save(public_path('uploading/' .  $time . '.webp'));
            }
            $insertTODatabase = DB::table('sittings')->insert([
                'nameWebsite' => $request->nameWebsite,
                'linkWebsite' => $request->linkWebsite,
                'Description' => $request->Description,
                'socialMidiaFacebook' => $request->socialMidiaFacebook,
                'socialMidiaTelegram' => $request->socialMidiaTelegram,
                'socialMidiaInstagram' => $request->socialMidiaInstagram,
                'socialMidiaYoutube' => $request->socialMidiaYoutube,
                'Keywords' => $request->Keywords,
                'insertQuick' => $request->insertCheck,
                'Is_hide' => $request->btnhide,
                'favicon' => $time . '.' . 'webp',
                'image_default' => $timeImgDefault . '.' . 'webp'
            ]);
            return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
        }
    }

}
