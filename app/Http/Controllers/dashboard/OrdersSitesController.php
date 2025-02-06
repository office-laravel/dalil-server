<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Sites;
use Illuminate\Support\Facades\DB;

class OrdersSitesController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function orderShow() {
        $orders = DB::table('orders_guest')->select('id','name', 'id_site', 'description', 'is_approve')->get();
        // dd($orders);
        return view('dash-board.waitordersite.siteOrder', compact('orders'));
    }

    public function approve($id){
        $sites = Sites::select('id', 'description')->first();
        $orders_sites = Order::where('id', $id)->first();
        if(isset($id)){
            DB::table('orders_guest')->where('id', $id)->update([
                'is_approve' => 1,
            ]);
            DB::table('sites')->where('id', $orders_sites->id_site)->update([
                'description' => $orders_sites->description,
                'facebook' => $orders_sites->facebook,
                'twitter' => $orders_sites->twitter,
                'instagram' => $orders_sites->instagram,
                'snapchat' => $orders_sites->snapchat,
                'youtube' => $orders_sites->youtube,
                'telegram' => $orders_sites->telegram,
                'LinkedIn' => $orders_sites->LinkedIn,
            ]);
        }

        return redirect()->back();
    }

    public function destroy($id){
        $orderById = Order::find($id);
        $orderById->delete();
        return redirect()->back();
    }

    public function edit($id){
        $orderById = Order::find($id);
        return view('dash-board.waitordersite.editSiteOrder', compact('orderById'));
    }
    public function update($id, Request $request){
        // $orderById = Order::find($id);
        DB::table('orders_guest')->where('id', $id)->update([
            'description' => $request->description,
            'facebook' => $request->facebook,
            'telegram' => $request->telegram,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'snapchat' => $request->snapchat,
            'youtube' => $request->youtube,
            'LinkedIn' => $request->linkedin,
        ]);
        return redirect()->route('sites.order')->with('تم تعديل المعلومات بنجاح');
    }
}
