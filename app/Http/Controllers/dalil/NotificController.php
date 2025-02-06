<?php

namespace App\Http\Controllers\dalil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class NotificController extends Controller
{
    public function notificAjaxButton(Request $request, $id) {
        $reqName = $request->nameSite;
        $reqHref = $request->href;

        if(empty($reqName)){
            return response()->json([
                'status' => 422,
                'message' => 'هناك خطأ في الاسم',
            ]);
        }
        else{

            $notific = DB::table('notification')->insert([
                'nameSite' => $reqName,
                'href'     => $reqHref,
                'sites_id' => $id,
            ]);
            return  response()->json([
                'status' => 200,
                'notific' => $notific,
                'message' => 'تم إعلام المشرف'
            ]);
        }
    }
}
