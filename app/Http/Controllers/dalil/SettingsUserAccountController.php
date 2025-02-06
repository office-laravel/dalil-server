<?php

namespace App\Http\Controllers\dalil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\sitting;
use App\Models\Countries;
use App\Models\PinnedPages;
use App\Models\Adds;

class SettingsUserAccountController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function settingAccount(){
        $Settings = sitting::first();
        $country_names = Countries::select('id', 'country_name','href' , 'country_flag')->get();
        $all_pinned_page = PinnedPages::all();
        $adds = Adds::first();
        $getUserAuth = Auth::user();
        return view('dalil.Auth_User.SettingAccount' , compact('adds','getUserAuth','Settings', 'country_names', 'all_pinned_page'));
    }

    public function updatesettingAccount(Request $request){

        // $email = $request->input('email_user');
        // $pass = $request->input('password');

        // update the user information in the database
        if($request->email){
            $validator =$request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email']
            ]);

            DB::table('users')->where('id', Auth::user()->id)->update([
                'email' => $request->email,
            ]);
        }
        else
        {

            if($request->password){
                 $validator =$request->validate([
                    'password' => ['required', 'confirmed'],
                    'password_confirmation' => 'required|min:8',
                ]);
                DB::table('users')->where('id', Auth::user()->id)->update([
                    'password' => Hash::make($request->password),

                ]);
            }
        }

        return redirect()->route('mainPageSetting.userr',Auth::user()->en_name)->with('msg', 'تم تحديث البيانات');
    }
}
