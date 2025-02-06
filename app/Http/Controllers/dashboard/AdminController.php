<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use Carbon\Carbon;

class AdminController extends Controller
{
    // public function __construct(){
    //     $this->middleware('admin');
    // }
    public function index(){
        return view('dash-board.login.admin_login');
    }

    public function Dashboard(){
        return view('dash-board.rtl');
    }

    public function Login(Request $request){
        // dd($request->all());
        $check =  $request->all();
        $remember = $request->has('remember');
        if(Auth::guard('admin')->attempt(['email' => $check['email'] , 'password'=>$check['password']], $remember)){
            return redirect('admin/dashboard/')->with('error' , 'تم تسجيل دخول المشرف بنجاح');
        }else{
            return back()->with('error' , 'البريد الإلكتروني أو كلمة المرور خاطئة');
        }
    }

    public function AdminRegister(){
        return view('dash-board.login.register');
    }
    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error' , 'تم تسجيل خروج المسؤول بنجاح');
    }

    public function AdminRegisterCreate(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'name'      => ['required', 'string', 'max:255'],
        //     'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password'  => ['required', 'confirmed']
        // ]);
        Admin::insert([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('login_form')->with('error' , 'تم إنشاء المسؤول بنجاح');
    }
    
    // Section Edit Managers
    
    public function showAllManagers(){
        $managers = Admin::latest()->get();
        
        return view('dash-board.managers.index', compact('managers'));
    }
    public function editManagers($id){
        $managers = Admin::find($id);
        
        return view('dash-board.managers.edit', compact('managers'));
    }
    public function updateManagers(Request $request, $id){
        $managers = Admin::find($id);
        Admin::where('id', $managers->id)->update([
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);
        return redirect()->route('managers.main')->with('success', 'تم تعديل معلومات المدير بنجاح');
    }
    

}
