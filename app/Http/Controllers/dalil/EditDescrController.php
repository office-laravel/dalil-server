<?php

namespace App\Http\Controllers\dalil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sites;
use App\Models\OrderGuest;
use Illuminate\Support\Facades\DB;

class EditDescrController extends Controller
{
    public function editByUserAjax(Request $request, $id) {
        $reqName = $request->name;
        $reqDescr = $request->descr;
        $req_facebook_link = $request->facebook;
        $req_telegram = $request->telegram;
        $req_instagram_link = $request->instagram;
        $req_youtube_link = $request->youtube;
        $req_linkedin_link = $request->linkedin;
        $req_twitter_link = $request->twitter;
        $req_snapchat_link = $request->snapchat;
        // dd($id);
        if(empty($reqDescr)){
            return response()->json([
                'status' => 422,
                'message' => 'Description cannot be empty',
            ]);
        }
        else{

            $sites = DB::table('orders_guest')->insert([
                'name' => $reqName,
                'id_site' => $id,
                'description' => $reqDescr,
                'facebook' => $req_facebook_link,
                'telegram' => $req_telegram,
                'twitter'  => $req_twitter_link,
                'instagram' => $req_instagram_link,
                'snapchat' => $req_snapchat_link,
                'youtube' => $req_youtube_link,
                'LinkedIn' => $req_linkedin_link,
                'is_approve' => 0,
            ]);
            return  response()->json([
                'status' => 200,
                'sites' => $sites,
                'message' => 'تم تعديل نبذة عن الموقع بانتظار المشرف الموافقة عليها'
            ]);
        }


        // return response()->json(['sites' => $sites]);
    }
}
