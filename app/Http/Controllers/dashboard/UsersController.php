<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UsersController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(100);
        
        return view('dash-board.users.index', compact('users'));
    }
    public function edit($id){
        $users = User::find($id);
        
        return view('dash-board.users.edit', compact('users'));
    }
    public function update(Request $request, $id){
        $users = User::find($id);
        User::where('id', $users->id)->update([
            'en_name' => $request->en_name,
        ]);
        return redirect()->route('users.main')->with('success', 'تم تعديل يوزر بنجاح');
    }
    public function destroy($id){
        $users = User::find($id);
        $users->delete();   
        return redirect()->route('users.main')->with('success', 'تم حذف يوزر بنجاح');
    }
    
    
}
