<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sites;

class AlertController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function notificationShow() {
        $notific = DB::table('notification')->select('id','nameSite', 'href')->get();
        // dd($orders);
        return view('dash-board.sectionNotification.NotificAll', compact('notific'));
    }


    public function destroy($id){
        $notificById = Notification::findOrFail($id);
        $notificById->delete();
        return redirect()->back();
    }

    public function edit($id){
        $notificById = Notification::findOrFail($id);
        return view('dash-board.sectionNotification.editNotific', compact('notificById'));
    }
    public function update($id, Request $request){
        $notific = Notification::find($id);
        if(isset($id))
        {
            DB::table('notification')->where('id', $id)->update([
                'nameSite' => $request->nameSite,
                'href' => $request->href,
            ]);
        }


        return redirect()->route('notification')->with('تم تعديل المعلومات بنجاح');
    }

    public function updateSitesLink($id){
        $notiID = DB::table('notification')->where('id', $id)->select('id', 'sites_id', 'href')->first();
        DB::table('sites')->where('id', $notiID->sites_id)->update([
            'href' => $notiID->href,
        ]);
        return redirect()->route('notification')->with('تم تعديل المعلومات الموقع بنجاح');
    }
}
