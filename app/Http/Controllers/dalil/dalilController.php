<?php

namespace App\Http\Controllers\dalil;
// session_start();
use App\Http\Controllers\Controller;
use App\Models\Adds;
use App\Models\Category;
use App\Models\sitting;
use App\Models\Countries;
use App\Models\City;
use App\Models\FixedSites;
use App\Models\FixedSiteNews;
use App\Models\PinnedPages;
use App\Models\Sites;
use App\Models\Tag;
use App\Models\Sites_tag;
use App\Models\News;
use App\Models\FixedSitesMain;
use Auth;
use Illuminate\Support\Facades\DB;
use Prophecy\Exception\Doubler\ReturnByReferenceException;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
class dalilController extends Controller
{
    public function index(Request $request)
    {
        $Settings = sitting::first();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $cities = City::select('id', 'name', 'latitude', 'longitude')->get();
        $all_pinned_page = PinnedPages::all();
        $adds = Adds::first();
        $fixedmainsites = FixedSitesMain::get();
        $news = News::latest()->take(4)->get();
        $categories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        // dd($request);
        return view('dalil.main_index', compact('news', 'fixedmainsites', 'adds', 'Settings', 'country_names', 'all_pinned_page', 'categories', 'cities'));
    }



    public function getCountry($href)
    {
        // $currenturl = url()->full();

        // dd($currenturl);
        // $getIdCountry = Countries::where('href' , $href)->select('id' , 'href')->firstOrFail();

        $news = News::latest()->take(4)->get();
        $getIdCountry = Countries::with('sites')->select('id', 'href')->where('href', $href)->firstOrFail();
        $Settings = sitting::first();
        $adds = Adds::first();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $is_SetCountry = Countries::select('id', 'country_name', 'href', 'country_flag')->where('href', $href)->first();
        $getfixed_sites = Countries::with(['fixedsite'])->where('href', $href)->first();
        $category_change_country = Countries::with(['category', 'sites'])->where('href', $href)->first();
        $getAllCate = Category::get();
        // dd($getAllCate);
        $all_pinned_page = PinnedPages::all();
        $country = Countries::select('id', 'country_name', 'href', 'title', 'description', 'keyword')->where('href', $href)->first();
        $getMeta_descr_getcountry = DB::table('countries')->select('id', 'href', 'meta_descr')->where('href', $href)->first();
        return view('dalil.index', compact(['news', 'getMeta_descr_getcountry', 'adds', 'getIdCountry', 'getAllCate', 'country', 'all_pinned_page', 'category_change_country', 'Settings', 'country_names', 'is_SetCountry', 'getfixed_sites']));



    }


    public function showCategory($country_href, $href)
    {
        $Settings = sitting::first();
        $adds = Adds::first();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $is_SetCountry = Countries::select('id', 'country_name', 'href', 'country_flag')->where('href', $country_href)->first();
        $subCat = Category::with(['supcategories', 'sites'])->where('href', $href)->first();
        // dd($subCat);
        $subCatbyCategory = Category::with([
            'supcategories',
            'sites' => function ($q) use ($country_href) {
                $countryID = Countries::where('href', $country_href)->first();
                $q->where('countries_id', $countryID->id);
            }
        ])->where('href', $href)->get();
        // dd($subCatbyCategory);
        $getIdCountry = Countries::select('id', 'href')->where('href', $country_href)->first();
        $all_pinned_page = PinnedPages::all();
        $category_meta = Countries::with('category')->select('id', 'href')->where('href', $country_href)->first();
        $getMeta = Category::select(['id', 'category_name', 'country_id', 'href'])->where('href', $href)->first();
        $getCountryNameofSubCat = Countries::select('id', 'href', 'country_name')->where('href', $country_href)->first();
        $getAllCategory = Category::where('parent_id', 0)->get();
        $category_change_country = Countries::with(['category', 'sites'])->where('href', $country_href)->first();

        return view('dalil.categoryPage', compact(['country_href', 'subCatbyCategory', 'adds', 'getCountryNameofSubCat', 'category_change_country', 'getAllCategory', 'getIdCountry', 'getMeta', 'category_meta', 'all_pinned_page', 'subCat', 'is_SetCountry', 'country_names', 'Settings']));
    }
    public function showSubCategoryByCategory($country_name, $category_href, $setname)
    {
        $Settings = sitting::first();
        $adds = Adds::first();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $is_SetCountry = Countries::select('id', 'country_name', 'href', 'country_flag')->where('href', $country_name)->first();
        $getIdCountry = Countries::select('id', 'href')->where('href', $country_name)->first();
        $all_pinned_page = PinnedPages::all();
        $CatbyName = Category::where('href', $category_href)->first();
        $subCatbyName = Category::with(['supcategories'])->where('href', $setname)->first();

        $subCatbyCategory = Category::with(['supcategories', 'sites'])->where('href', $category_href)->where('href', $setname)->get();
        $getCompaniesOfSubCategory = Sites::select('id', 'category_id', 'logo', 'site_name', 'title', 'views', 'subcategories')
            ->where('category_id', $CatbyName->id)
            ->where('subcategories', $subCatbyName->id)
            ->get();
        // dd($getCompaniesOfSubCategory);
        return view('dalil.showSubCategoryByCategory', compact('getCompaniesOfSubCategory', 'country_name', 'subCatbyName', 'setname', 'subCatbyCategory', 'Settings', 'adds', 'country_names', 'is_SetCountry', 'all_pinned_page'));
    }

    public function about($href)
    {
        $adds = Adds::first();
        $Settings = sitting::first();
        // $findIdd = PinnedPages::findOrFail($id);
        $all_pinned_page = PinnedPages::all();
        $get_content = PinnedPages::select('id', 'page_name', 'href', 'content')->where('href', $href)->get();
        $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();
        // return $all_pinned_page;
        $title_about = PinnedPages::select('id', 'title')->where('id', $href)->first();
        $get_about_waslat = PinnedPages::select('id', 'page_name', 'href', 'content')->first();
        $country_namess = Countries::select('id', 'country_name', 'href')->where('id', $href)->first();
        $getTitle_About = PinnedPages::select('id', 'page_name', 'href', 'keyword', 'title')->where('href', $href)->first();
        return view('dalil.about', compact(['Settings', 'adds', 'getTitle_About', 'country_namess', 'get_about_waslat', 'title_about', 'country_names', 'all_pinned_page', 'get_content']));
    }

    public function showDescr($country_id, $id)
    {

        $adds = Adds::first();
        $Settings = sitting::first();
        $get_site_descr = Sites::with('country', 'category', 'tags')->select('id', 'site_name', 'href', 'title', 'description', 'keyword', 'category_id', 'countries_id', 'facebook', 'twitter', 'instagram', 'telegram')->where('id', $id)->where('confirmed', 1)->get();
        // dd($get_site_descr);
        $get_categoryTo_descr = Sites::with(['country', 'category'])->select('id', 'category_id', 'countries_id', 'title')->where('id', $id)->where('confirmed', 1)->first();
        $get_SupCategory = Sites::with(['country', 'category'])->select('id', 'category_id', 'countries_id', 'subcategories', 'title')->where('id', $id)->where('confirmed', 1)->first();
        $scategories = Category::where('parent_id', '!=', 0)->get();
        $get_site_descrr = Sites::with('country', 'category', 'tags')->select('id', 'site_name', 'href', 'description', 'title', 'facebook', 'twitter', 'instagram', 'snapchat', 'youtube', 'telegram')->where('id', $id)->where('confirmed', 1)->first();
        $addss = Adds::select('atTop', 'atRight', 'otherSite', 'atHead')->first();
        $is_setTags = Sites::with('tags')->where('id', $id)->first();
        $getterTage = '';
        $is_SetCountry = Countries::select('id', 'country_name', 'href', 'country_flag')->where('href', $country_id)->first();
        $articaleSites = Sites::where('id', $id)->where('countries_id', $is_SetCountry->id)->where('confirmed', 1)->first();
        $getCityName = City::where('id', $articaleSites->cities_id)->first();
        $getNameCategory = Category::select('id', 'category_name', 'href')->where('id', $articaleSites->category_id)->first();
        $getNameSubCategory = Category::select('id', 'category_name', 'href')->where('id', $articaleSites->subcategories)->first();

        $country_names = Countries::select('id', 'country_name', 'country_flag', 'href')->get();
        $all_pinned_page = PinnedPages::get();
        $gg = Countries::select('id')->first();
        $selectCountry = Sites::with('country', 'category')->select('id', 'href', 'title', 'countries_id')->where('id', $id)->where('confirmed', 1)->first();
        $getTagTitle = Sites::select('id', 'href', 'site_name')->where('id', $id)->where('confirmed', 1)->first();
        $getMetaDescr = Sites::select('id', 'href', 'site_name', 'description')->where('id', $id)->where('confirmed', 1)->first();
        // $viewsSites = Sites::select('views' , 'title')->where('title', $title)->first();
        // $views=$viewsSites->views;
        // $views=$views+1;
        // Sites::where('title',$title)->update(['views'=>$views]);

        // $getDataOfCompany = Sites::where('title')
        $viewsSit = Sites::select('id', 'title', 'views')->where('id', $id)->first();
        $getLatestCompany = Sites::select('id', 'logo', 'site_name', 'href', 'category_id', 'countries_id', 'views')->latest()->get();
        // dd($ff);
        return view('dalil.describtion', compact([
            'getNameSubCategory',
            'getNameCategory',
            'Settings',
            'is_SetCountry',
            'getCityName',
            'getLatestCompany',
            'articaleSites',
            'viewsSit',
            'adds',
            'getterTage',
            'get_site_descr',
            'get_categoryTo_descr',
            'scategories',
            'get_SupCategory',
            'get_site_descrr',
            'addss',
            'country_names',
            'all_pinned_page',
            'selectCountry',
            'getTagTitle',
            'getMetaDescr'
        ]));
        // return view('dalil.describtion' , compact([ 'scategories' ,'addss','get_site_descrr','country_namess','get_about_waslat','get_SupCategory','get_categoryTo_descr','title_descr','DataSittings' , 'country_names' , 'all_pinned_page' , 'get_site_descr']));
    }
    public function showby_id($id)
    {

        $adds = Adds::first();
        $Settings = sitting::first();
        $get_site_descr = Sites::with('country', 'category', 'tags')->select('id', 'site_name', 'href', 'title', 'description', 'keyword', 'category_id', 'countries_id', 'facebook', 'twitter', 'instagram', 'telegram')->where('id', $id)->where('confirmed', 1)->get();
        // dd($get_site_descr);
        $get_categoryTo_descr = Sites::with(['country', 'category'])->select('id', 'category_id', 'countries_id', 'title')->where('id', $id)->where('confirmed', 1)->first();
        $get_SupCategory = Sites::with(['country', 'category'])->select('id', 'category_id', 'countries_id', 'subcategories', 'title')->where('id', $id)->where('confirmed', 1)->first();
        $scategories = Category::where('parent_id', '!=', 0)->get();
        $get_site_descrr = Sites::with('country', 'category', 'tags')->select('id', 'site_name', 'href', 'description', 'title', 'facebook', 'twitter', 'instagram', 'snapchat', 'youtube', 'telegram')->where('id', $id)->where('confirmed', 1)->first();
        $addss = Adds::select('atTop', 'atRight', 'otherSite', 'atHead')->first();
        $is_setTags = Sites::with('tags')->where('id', $id)->first();
        $getterTage = '';

        $Sites = Sites::find($id);
        $country_id = $Sites->country_id;
        $is_SetCountry = Countries::select('id', 'country_name', 'href', 'country_flag')->where('id', $country_id)->first();
        //  $articaleSites = Sites::where('id', $id)->where('countries_id', $country_id)->where('confirmed', 1)->first();
        $articaleSites = null;
        // $getCityName = City::where('id', $articaleSites->cities_id)->first();
        // $getNameCategory = Category::select('id', 'category_name', 'href')->where('id', $articaleSites->category_id)->first();
        //$getNameSubCategory = Category::select('id', 'category_name', 'href')->where('id', $articaleSites->subcategories)->first();
        $getCityName = null;
        $getNameCategory = null;
        $getNameSubCategory = null;
        $country_names = Countries::select('id', 'country_name', 'country_flag', 'href')->get();
        $all_pinned_page = PinnedPages::get();
        $gg = Countries::select('id')->first();
        $selectCountry = Sites::with('country', 'category')->select('id', 'href', 'title', 'countries_id')->where('id', $id)->where('confirmed', 1)->first();
        $getTagTitle = Sites::select('id', 'href', 'site_name')->where('id', $id)->where('confirmed', 1)->first();
        $getMetaDescr = Sites::select('id', 'href', 'site_name', 'description')->where('id', $id)->where('confirmed', 1)->first();
        // $viewsSites = Sites::select('views' , 'title')->where('title', $title)->first();
        // $views=$viewsSites->views;
        // $views=$views+1;
        // Sites::where('title',$title)->update(['views'=>$views]);

        // $getDataOfCompany = Sites::where('title')
        $viewsSit = Sites::select('id', 'title', 'views')->where('id', $id)->first();
        $getLatestCompany = Sites::select('id', 'logo', 'site_name', 'href', 'category_id', 'countries_id', 'views')->latest()->get();
        // dd($ff);
        return view('dalil.describtion', compact([
            'getNameSubCategory',
            'getNameCategory',
            'Settings',
            'is_SetCountry',
            'getCityName',
            'getLatestCompany',
            'articaleSites',
            'viewsSit',
            'adds',
            'getterTage',
            'get_site_descr',
            'get_categoryTo_descr',
            'scategories',
            'get_SupCategory',
            'get_site_descrr',
            'addss',
            'country_names',
            'all_pinned_page',
            'selectCountry',
            'getTagTitle',
            'getMetaDescr'
        ]));
        // return view('dalil.describtion' , compact([ 'scategories' ,'addss','get_site_descrr','country_namess','get_about_waslat','get_SupCategory','get_categoryTo_descr','title_descr','DataSittings' , 'country_names' , 'all_pinned_page' , 'get_site_descr']));
    }

    public function showTag($id)
    {
        $Settings = sitting::first();
        $adds = Adds::first();
        $all_pinned_page = PinnedPages::all();
        $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();
        $subcats = Category::with('supcategories')->where('parent_id', $id)->get();
        $test = Sites::with('tags')->where('category_id', $id)->get();
        $titlee = Category::select('id', 'title')->where('id', $id)->first();
        $country_namess = Category::with('country')->where('id', $id)->first();
        $get_about_waslat = PinnedPages::select('id', 'page_name', 'href', 'content')->first();
        $getUrlTagName = str_replace('-', ' ', $id);
        $tagss = Tag::with('sites')->where('name', $getUrlTagName)->select('id', 'name')->get();
        $getUrlTagName = str_replace('-', ' ', $id);
        $tagSam = Tag::with('sites')->where('name', $getUrlTagName)->select('id', 'name')->first();


        // dd($tagSam);
        return view('dalil.tagsSites', compact(['tagSam', 'Settings', 'adds', 'tagss', 'all_pinned_page', 'country_names', 'subcats', 'test', 'titlee', 'country_namess', 'get_about_waslat']));
    }


    // Add Sites by user

    public function createSites()
    {
        $adds = Adds::first();
        $category = Category::with('sites', 'country')->where('parent_id', 0)->where('show_status', 1)->get();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $tags = Tag::all();
        $categories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        $countries = Countries::all();
        $all_pinned_page = PinnedPages::all();
        $Settings = sitting::first();
        $cities = City::select('id', 'name')->get();
        return view('dalil.pageCreateSites', compact(['Settings', 'all_pinned_page', 'adds', 'tags', 'categories', 'countries', 'category', 'country_names', 'cities']));
    }
    public function editSites($id)
    {
        $site = Sites::find($id);
        $adds = Adds::first();
        $category = Category::with('sites', 'country')->where('parent_id', 0)->where('show_status', 1)->get();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $tags = Tag::all();
        $categories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        $countries = Countries::all();
        $all_pinned_page = PinnedPages::all();
        $Settings = sitting::first();
        $cities = City::select('id', 'name')->get();
        return view('dalil.pageEditSites', compact([
            'Settings',
            'all_pinned_page',
            'adds',
            'tags',
            'categories',
            'countries',
            'category',
            'country_names',
            'cities',
            'site'
        ]));
    }
    public function supCate(Request $request)
    {
        $parent_id = $request->cat_id;
        // dd($parent_id);
        $supcategories = Category::where('id', $parent_id)
            ->with('supcategories')
            ->get();
        // return $supcategories;
        return response()->json(['supcategories' => $supcategories]);
    }
    public function StoreSites(Request $request)
    {
        $valid = $request->validate(
            [
                'site_name' => 'required',
                'href' => 'required|unique:sites,href',
                // 'title'         => 'required',
                // 'name'          => 'required',
                // 'description'   => 'required',
                'countries_id' => 'nullable',
                'category' => 'required',
                //  'subcategory' => 'required',
                // 'keyword'       => 'required'
                // 'tags'          => 'required'
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
            ],
            [
                'countries_id.required' => 'الرجاء ادخال اسم الدولة',
                'category.required' => 'الرجاء ادخال اسم التصنيف ',
                'subcategory.required' => 'الرجاء ادخال اسم التصنيف الفرعي',
            ]
        );
        if ($valid) {
            $latitude = null;
            $longitude = null;
            if ($request->input('latitude') && $request->input('longitude')) {
                $latitude = $request->input('latitude');
                $longitude = $request->input('longitude');
            }
            $city_id = null;
            $subcity_id = null;
            if ($request->input('city_id')) {
                $city_id = $request->input('city_id');

                if ($request->input('subcity')) {
                    $subcity_id = $request->input('subcity');
                }
            }

            /*
           city_id
           subcity
            */

            if ($request->logo) {
                $time = time();
                $filePath = public_path('picCompany/' . $time . '.' . 'webp');
                Image::make($request->file('logo')->getRealPath())->encode('webp', 100)->resize(228, 170)->save($filePath);
                $savingPic = $time . '.' . 'webp';


                $mydataSites = Sites::create([
                    'site_name' => $request->input('site_name'),
                    'href' => $request->input('href'),
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'articale' => $request->input('articale'),
                    'countries_id' => $request->countries_id,
                    'logo' => $savingPic,
                    'cities_id' => $request->cities_id,
                    'mobile_number' => $request->mobile_number,
                    'phone_number' => $request->phone_number,
                    'video' => $request->video,
                    'keyword' => $request->input('keyword'),

                    'facebook' => $request->input('facebook'),
                    'twitter' => $request->input('twitter'),
                    'instagram' => $request->input('instagram'),
                    'snapchat' => $request->input('snapchat'),
                    'youtube' => $request->input('youtube'),
                    'telegram' => $request->input('telegram'),
                    'android' => $request->input('android'),
                    'ios' => $request->input('ios'),
                    'priority' => $request->input('priority'),
                    'subcategories' => $request->subcategory ? $request->subcategory : 0,
                    'category_id' => $request->category ? $request->category : 0,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'city_id' => $city_id,
                    'subcity_id' => $subcity_id,
                    // 'is_show_all_sites' => $request->all_sites ? true : false ,
                ]);
                // $tagg = [];
                if ($request->tags) {
                    foreach (explode(',', $request->tags) as $tagss) {
                        $taggs = Tag::create([
                            'name' => $tagss,

                        ]);
                        $mydataSites->tags()->attach($taggs);
                    }
                }

            } else {
                $mydataSites = Sites::create([
                    'site_name' => $request->input('site_name'),
                    'href' => $request->input('href'),
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'articale' => $request->input('articale'),
                    'countries_id' => $request->countries_id,
                    'logo' => Null,
                    'cities_id' => $request->cities_id,
                    'mobile_number' => $request->mobile_number,
                    'phone_number' => $request->phone_number,
                    'video' => $request->video,
                    'keyword' => $request->input('keyword'),

                    'facebook' => $request->input('facebook'),
                    'twitter' => $request->input('twitter'),
                    'instagram' => $request->input('instagram'),
                    'snapchat' => $request->input('snapchat'),
                    'youtube' => $request->input('youtube'),
                    'telegram' => $request->input('telegram'),
                    'android' => $request->input('android'),
                    'ios' => $request->input('ios'),
                    'priority' => $request->input('priority'),
                    'subcategories' => $request->subcategory ? $request->subcategory : 0,
                    'category_id' => $request->category ? $request->category : 0,
                    // 'is_show_all_sites' => $request->all_sites ? true : false ,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'city_id' => $city_id,
                    'subcity_id' => $subcity_id,
                ]);
                // $tagg = [];
                if ($request->tags) {
                    foreach (explode(',', $request->tags) as $tagss) {
                        $taggs = Tag::create([
                            'name' => $tagss,

                        ]);
                        $mydataSites->tags()->attach($taggs);
                    }
                }

            }



            /*
                        return redirect()->route('sites.main')
                            ->with('success', 'Successfuly added data');
            */
            return redirect()->back()->with('msgsuccess', 'تم اضافة الموقع وهو في حالة انتظار المشرف للموافقة عليه');

            // ->with('success' , 'Successfuly added data');
        }
    }

    //update
    public function update(Request $request, $id)
    {

        $sites = Sites::find($id);
        $request->validate([
            'site_name' => 'required',
            'href' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($request->hasFile('logo')) {
            $pathImg = str_replace('\\', '/', public_path('picCompany/')) . $sites->logo;
            if (File::exists($pathImg)) {
                File::delete($pathImg);
            }
            $time = time();
            $image = Image::make($request->file('logo')->getRealPath())->encode('webp', 100)->resize(228, 170)->save(public_path('picCompany/' . $time . '.webp'));

            $sites->logo = $time . '.' . 'webp';
            $sites->update();
        }
        $get_tags_id = DB::table('sites_tag')->where('sites_id', $sites->id)->get();
        // $get_tags_id = Sites_tag::where('sites_id' , $sites->id)->get();
        if (count($get_tags_id) > 0) {
            foreach ($get_tags_id as $tag_id) {
                Tag::where('id', $tag_id->tag_id)->delete();
                Sites_tag::where('sites_id', $sites->id)->delete();
            }

        }
        if ($request->tags) {
            foreach (explode(',', $request->tags) as $tagss) {

                $tag = Tag::where('name', '=', $tagss)->first();
                if ($tag != null) {
                    $sites->tags()->sync($tag->id);
                } else {
                    $taggs = Tag::create([
                        'name' => $tagss,
                    ]);
                    $sites->tags()->attach($taggs);
                }

                // $taggs = DB::table('tags')->update([
                // 'name' => $tagss,
                // ]);
                // $taggs = Tag::create([
                //     'name' => $tagss,
                // ]);

            }

        }

        if ($sites->countries_id || $sites->subcategories || $sites->category_id || $request->cities_id) {
            DB::table('sites')->where('id', $id)->update([
                'countries_id' => $request->countries_id,
                'subcategories' => $request->subcategory,
                'category_id' => $request->category,
                'cities_id' => $request->cities_id
            ]);
        }

        $latitude = null;
        $longitude = null;
        if ($request->latitude && $request->longitude) {
            $latitude = $request->latitude;
            $longitude = $request->longitude;
        }
        $city_id = null;
        $subcity_id = null;
        if ($request->input('city_id')) {
            $city_id = $request->input('city_id');

            if ($request->input('subcity')) {
                $subcity_id = $request->input('subcity');
            }
        }
        $sites->site_name = $request->site_name;
        $sites->href = $request->href;
        $sites->title = $request->title;
        $sites->description = $request->description;
        $sites->articale = $request->articale;
        $sites->mobile_number = $request->mobile_number;
        $sites->phone_number = $request->phone_number;
        $sites->video = $request->video;
        // $sites->countries_id = $request->countries_id;
        // $sites->subcategories = $request->subcategory ? $request->subcategory : 0 ;
        // $sites->category_id   = $request->category ? $request->category : 0 ;
        $sites->keyword = $request->keyword;
        $sites->facebook = $request->facebook;
        $sites->twitter = $request->twitter;
        $sites->instagram = $request->instagram;
        $sites->snapchat = $request->snapchat;
        $sites->youtube = $request->youtube;
        $sites->telegram = $request->telegram;
        $sites->android = $request->android;
        $sites->ios = $request->ios;
        $sites->priority = $request->priority;
        // $sites->is_show_all_sites = $request->all_sites;
        $sites->latitude = $latitude;
        $sites->longitude = $longitude;
        $sites->city_id = $city_id;
        $sites->subcity_id = $subcity_id;

        $sites->update();
        return redirect()->route('pageme.user', Auth::user()->en_name)
            ->with('success', 'تم التعديل بجاح');

    }
    //delete
    public function destroy($id)
    {
        $user_id = Auth::check() ? Auth::user()->id : null;
        $sites = Sites::find($id);
        //check owner
        if ($user_id != null) {
            if ($user_id == $sites->user_id) {
                $getSites_id = DB::table('sites_tag')->where('sites_id', $id)->get();
                foreach ($getSites_id as $val) {
                    DB::table('tags')->where('id', $val->tag_id)->delete();
                }
                DB::table('sites_tag')->where('sites_id', $id)->delete();
                $pathImg = str_replace('\\', '/', public_path('picCompany/')) . $sites->logo;
                if (File::exists($pathImg)) {
                    File::delete($pathImg);
                }


                $sites->delete();
            }
        }



        // return redirect()->route('sites.main')
        //     ->with('success' , 'Successfuly deleted data');
        return redirect()->back();
    }

    public function getAllNews()
    {
        $getfixedsitesnews = FixedSiteNews::select('id', 'name', 'link', 'img')->get();
        $Settings = sitting::first();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $all_pinned_page = PinnedPages::all();
        $adds = Adds::first();
        $news = News::select('id', 'title', 'image')->latest()->paginate(20)->withQueryString();
        // dd($news);
        return view('dalil.allNews', compact('Settings', 'country_names', 'getfixedsitesnews', 'all_pinned_page', 'adds', 'news'));
    }
    public function getDescrNews($id)
    {
        $getfixedsitesnews = FixedSiteNews::select('id', 'name', 'link', 'img')->get();
        $Settings = sitting::first();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $all_pinned_page = PinnedPages::all();
        $adds = Adds::first();
        $titleNewsMeta = News::select('id', 'title')->where('id', $id)->first();
        $newsDescr = News::where('id', $id)->first();
        $viewsSites = News::select('id', 'views')->where('id', $id)->first();
        $views = $viewsSites->views;
        $views = $views + 1;
        News::where('id', $id)->update([
            'views' => $views
        ]);
        $news = News::select('id', 'title', 'image')
            ->get();
        return view('dalil.descrNews', compact('news', 'getfixedsitesnews', 'titleNewsMeta', 'Settings', 'country_names', 'all_pinned_page', 'adds', 'newsDescr'));
    }

    public function moreVisit()
    {
        $DataSittings = sitting::first();
        $all_pinned_page = PinnedPages::all();
        $country_namess = Countries::select('id', 'country_name', 'href', 'country_flag')->where('show_status', 1)->first();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $get_about_waslat = PinnedPages::select('id', 'page_name', 'href', 'content')->first();
        $adds = Adds::first();
        $more_visits = DB::table('sites')
            ->select('id', 'site_name', 'href', 'category_id', 'title', 'subcategories', 'countries_id', 'views', 'confirmed')
            ->orderBy('views', 'desc') // Use 'desc' for descending order, 'asc' for ascending order
            ->limit(40) // Limit the number of records to 40
            ->get();
        // dd($more_visits);
        $titleVisit = "الأكثر زيارة";

        return view('dalil.visits', compact('titleVisit', 'more_visits', 'adds', 'all_pinned_page', 'DataSittings', 'country_names', 'get_about_waslat'));
    }

    public function newSites()
    {
        $DataSittings = sitting::first();
        $all_pinned_page = PinnedPages::all();
        $country_namess = Countries::select('id', 'country_name', 'href', 'country_flag')->where('show_status', 1)->first();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $get_about_waslat = PinnedPages::select('id', 'page_name', 'href', 'content')->first();
        $adds = Adds::first();
        $new_Sites = DB::table('sites')
            ->select('id', 'site_name', 'href', 'category_id', 'title', 'subcategories', 'countries_id', 'views', 'confirmed')
            ->latest() // Use 'desc' for descending order, 'asc' for ascending order
            ->limit(40) // Limit the number of records to 40
            ->get();
        // dd($more_visits);
        $titleNewSites = "أحدث المواقع";

        return view('dalil.newSites', compact('titleNewSites', 'new_Sites', 'adds', 'all_pinned_page', 'DataSittings', 'country_names', 'get_about_waslat'));
    }

}

