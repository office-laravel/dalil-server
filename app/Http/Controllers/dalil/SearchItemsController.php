<?php

namespace App\Http\Controllers\dalil;

// session_start();

use App\Http\Controllers\Controller;
use App\Models\Adds;
use App\Models\Category;
use App\Models\Countries;
use App\Models\PinnedPages;
use App\Models\Sites;
use App\Models\sitting;
use App\Models\Subcity;
use Illuminate\Http\Request;

class SearchItemsController extends Controller
{

    public function search(Request $request)
    {
        $query = $request->q;

        if ($query != '') {
            $DataSittings = sitting::first();
            $all_pinned_page = PinnedPages::all();
            // $cat = Category::with('sites','country')->select('id' , 'category_name','href')->where('category_name', 'LIKE', '%' . $query . '%')->paginate(5);
            // dd($cat);
            $sitess = Sites::orderBy('priority', 'desc')->select('id', 'site_name', 'description', 'title', 'href', 'priority', 'confirmed')
                ->where('site_name', 'LIKE', '%' . $query . '%')
                ->orWhere('description', 'LIKE', '%' . $query . '%')->get();
            $country_namess = Countries::select('id', 'country_name', 'href', 'country_flag')->where('show_status', 1)->first();
            $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
            $get_about_waslat = PinnedPages::select('id', 'page_name', 'href', 'content')->first();
            $titleSearch = "بحث";
            $adds = Adds::first();
            // if(count($cat)){
            //     return view('dalil.search', compact('adds','country_namess', 'all_pinned_page', 'DataSittings' , 'country_names','get_about_waslat'));
            // }
            // $check_Priority = Sites::orderBy('priority', 'desc')
            // if($sitess->priority == $sitess->priority ){
            //     $sitess = Sites::orderBy('created_at', 'desc')->select('id' , 'site_name' , 'description','title','href', 'priority')
            //             ->where('site_name', 'LIKE', '%' . $query . '%')
            //             ->orWhere('description' , 'LIKE' ,'%' . $query . '%')->get();
            // }

            if (count($sitess)) {
                // dd($sitess);
                return view('dalil.search', compact('titleSearch', 'adds', 'sitess', 'all_pinned_page', 'DataSittings', 'country_names', 'get_about_waslat'));
            } else {
                return view('dalil.search', compact('titleSearch', 'adds', 'sitess', 'all_pinned_page', 'DataSittings', 'country_names', 'get_about_waslat'));
            }
        } else {
            return redirect()->back();
        }

    }

    public function query(Request $request)
    {
        $request->validate([
            'category' => 'nullable|string',
            'bounds' => 'required|json'
        ]);

        parse_str($request->formdata, $formData);

        $city_id = $formData['city_id'] ?? null;
        $subcity = $formData['subcity'] ?? null;
        $category = $formData['category'] ?? null;
        $subcategory = $formData['subcategory'] ?? null;
        $bounds = json_decode($request->bounds, true);
        $textsrc = $request->srchtxt;

        //$companies = Company::where('category', $request->category)
        $companies_query = Sites::whereBetween('latitude', [$bounds['south'], $bounds['north']])
            ->whereBetween('longitude', [$bounds['west'], $bounds['east']])->with('category:id,icon,title');
        //city + subcity
        if ($city_id && $city_id > 0) {
            $companies_query = $companies_query->where('city_id', $city_id);
            if ($subcity && $subcity > 0) {
                $companies_query = $companies_query->where('subcity_id', $subcity);
            }
        }
        //category + sub category
        if ($category && $category > 0) {
            $companies_query = $companies_query->where('category_id', $category);
            if ($subcategory && $subcategory > 0) {
                $companies_query = $companies_query->where('subcategories', $subcategory);
            }
        }
        if ($textsrc != '') {

            //  $companies_query = $companies_query->where('title', 'like', '%' . $textsrc . '%');

            $companies_query = $companies_query->where(
                function ($query) use ($textsrc) {
                    return $query
                        ->orWhere('title', 'like', '%' . $textsrc . '%')
                        ->orWhere('site_name', 'like', '%' . $textsrc . '%')
                        ->orWhere('mobile_number', 'like', '%' . $textsrc . '%')
                        ->orWhere('phone_number', 'like', '%' . $textsrc . '%')
                        ->orWhere('description', 'like', '%' . $textsrc . '%')
                        ->orWhere('articale', 'like', '%' . $textsrc . '%')
                        ->orWhere('keyword', 'like', '%' . $textsrc . '%')
                        ->orWhere('facebook', 'like', '%' . $textsrc . '%')
                        ->orWhere('twitter', 'like', '%' . $textsrc . '%')
                        ->orWhere('instagram', 'like', '%' . $textsrc . '%')
                        ->orWhere('snapchat', 'like', '%' . $textsrc . '%')
                        ->orWhere('youtube', 'like', '%' . $textsrc . '%')
                        ->orWhere('telegram', 'like', '%' . $textsrc . '%')
                        ->orWhere('LinkedIn', 'like', '%' . $textsrc . '%')
                    ;
                }
            );
            //site_name
        }

        $companies = $companies_query->select('id', 'category_id', 'subcategories', 'title', 'latitude', 'longitude', 'city_id', 'subcity_id')->get();

        // $companies = Company::get();
        return response()->json($companies);
    }
    public function getsublist($id)
    {
        $subcities = Subcity::where('city_id', $id)->select('id', 'city_id', 'subname', 'latitude', 'longitude')
            ->get();
        return response()->json($subcities);
    }

}
