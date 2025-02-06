<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sitting;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('dash-board.home');
    // }
    public function Rtl()
    {
        $DataSittings=sitting::where("id",1)->first();
        return view('dash-board.rtl',compact('DataSittings'));
    }


}
