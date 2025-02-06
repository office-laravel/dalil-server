<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Sites;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Searchajax extends Controller
{
    public function liveAjaxSearch(Request $request){
        
        
        if($request->ajax()){
            $output = '';
            $req = $request->q;
            $site = DB::table('sites')->select('id' , 'site_name','href','title', 'description')->where('site_name' , 'LIKE', '%'.$req.'%')
                        ->orWhere('description' , 'LIKE', '%'.$req.'%')
                        ->get();
            if(count($site) > 0){
                foreach($site as $sites){
                    
                    $output .='
                    <tr>
                        <th scope="row">'.$sites->id.'</th>
                        <td>'.$sites->site_name.'</td>
                        <td>'.$sites->href.'</td>
                        <td>'.$sites->title.'</td>
                        <td style="width: 50px">
                            <div class="row">
                                <div class="col-sm-2">
                                    <a href="'.route('sites.edit', $sites->id).'"><i
                                            class="fa-solid fa-pen-to-square"></i></a>
                                </di
                                <div class="col-sm">
                                    <a href="'.route('sites.destroy', ['id' => $sites->id]).'"><i
                                            class="fa-solid fa-trash-can"></i></a>
                                </div>
                            </div>


                        </td>
                    </tr>
                    
                    
                    ';
                    
                }
                
                return response()->json($output);
            }
            else
            {
                $output ='
                <tr>
                    <td class="text-center" colspan="5">لا يوجد شيئ</td>
                </tr>
                ';
             return response()->json($output);   
            }
        }
        
        return view('dash-board.sites.allDataSites');
        
    }
}
