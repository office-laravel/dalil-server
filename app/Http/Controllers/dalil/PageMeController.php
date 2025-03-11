<?php

namespace App\Http\Controllers\dalil;

use App\Http\Controllers\Controller;
use App\Models\Sites;
use Illuminate\Http\Request;
use App\Models\Adds;
use App\Models\sitting;
use App\Models\Countries;
use App\Models\PageMe;
use App\Models\PinnedPages;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;





class PageMeController extends Controller
{
    public function index()
    {
      //  $adds = Adds::first();
       // $all_pinned_page = PinnedPages::all();
     //   $DataSittings = sitting::where("id", 1)->first();
        $Settings = sitting::first();
     //  $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();
        $user_id = Auth::check() ? Auth::user()->id : null;
        $sites = null;
        if ($user_id) {
            $sites = Sites::where('user_id', $user_id)->select(
                'id',
                'site_name',
                'href',
                'category_id',
                'title'
            )->get();
        }

        return view('site.client.pageMe', compact(
          //  'country_names',
         //   'DataSittings',
            //'all_pinned_page',
           // 'adds',
            'sites',
            'Settings'
        ));
    }

    public function fetchSites()
    {
        $sites = DB::table('page_me')->where('users_id', Auth::user()->id)->get();

        return response()->json([
            'sites' => $sites,
        ]);
    }


    public function storeAjaxSitesMe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site' => 'required|max:191',
            'href' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $sites = new PageMe();
            $sites->name = $request->site;
            $sites->href = $request->href;
            $sites->users_id = Auth::user()->id;
            $sites->save();
            return response()->json([
                'status' => 200,
                'message' => 'تم اضافة الموقع',
            ]);
        }
    }

    public function editFetchSites($id)
    {
        $sites = PageMe::find($id);

        if ($sites) {
            return response()->json([
                'status' => 200,
                'sites' => $sites,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'massage' => 'Site Not Found',
            ]);
        }
    }

    public function updateFetchSites(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'site' => 'required|max:191',
            'href' => 'required|max:191',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
            ]);
        } else {
            $sites = PageMe::find($id);
            if ($sites && Auth::user()->id == $sites->users_id) {
                $sites->name = $request->site;
                $sites->href = $request->href;
                // $sites->users_id = Auth::user()->id;
                $sites->update();

                return response()->json([
                    'status' => 200,
                    'sites' => $sites,
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'massage' => 'Site Not Found',
                ]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'تم تحديث',
            ]);
        }

    }

    public function deleteFetchSites($id)
    {
        $sites = PageMe::find($id);
        if ($sites) {
            $sites->delete();
        }
        return response()->json([
            'status' => 200,
            'message' => 'تم حذف بنجاح',
        ]);

    }
}
