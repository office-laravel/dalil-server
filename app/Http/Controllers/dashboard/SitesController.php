<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\Sites;
use App\Models\Tag;
use App\Models\City;
use App\Models\Sites_tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Models\Countries;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\PackageUser;
class SitesController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $countROW = 12;
        $tags = Tag::latest()->get();
        $showSites = Sites::where('confirmed', 1)->latest()->paginate($countROW);
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $categories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        return view('dash-board.sites.allDataSites', compact('tags', 'showSites', 'country_names', 'categories'));
    }
    public function getSitesWithCountry($count_id)
    {
        $countROW = 12;
        $country_namess = Countries::select('id', 'country_name', 'country_flag', 'href')->where('id', $count_id)->first();
        $sites_show = Sites::with('country')->where('countries_id', $count_id)->where('confirmed', 1)->latest()->paginate($countROW);
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $category = Category::select('id', 'category_name')->where('parent_id', 0)->first();
        $categories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        return view('dash-board.sites.allDataSites', compact('sites_show', 'country_names', 'country_namess', 'category', 'categories'));
    }
    public function getSitesByCategory($cat_id)
    {
        $countROW = 12;
        $sites_show = Sites::with('category')->where('category_id', $cat_id)->where('confirmed', 1)->latest()->paginate($countROW);
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        $categorySet = Category::select('id', 'category_name')->where('id', $cat_id)->where('parent_id', 0)->first();
        $categories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        return view('dash-board.sites.allDataSites', compact('sites_show', 'country_names', 'categorySet', 'categories'));
    }
    public function create(Request $request)
    {
        $tags = Tag::all();
        // if($tags->count() == 0){
        //     return redirect()->route('tags.create');
        // }
        $categories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        $countries = Countries::all();
        $cities = City::select('id', 'name')->get();
        $users = User::select('id', 'email', 'name')->get();
        // return $countries;
        return view('dash-board.sites.createSites', compact(['tags', 'categories', 'countries', 'cities', 'users']));
    }
    // ****** get Cities Of Country

    public function getCitiesOfCountry(Request $request)
    {
        $countryID = $request->country_id;
        $getCities = City::where('country_id', $countryID)->get();
        return response()->json(['getCities' => $getCities]);
    }
    public function getCate(Request $request)
    {
        $country_id = $request->country_id;
        // dd($parent_id);
        $getCatt = Category::where('country_id', $country_id)
            ->where('parent_id', 0)
            ->get();
        return $getCatt;
        // return response()->json(['getCatt' => $getCatt]);
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




    public function store(Request $request)
    {
        // dd($request->logo);
        // dd($request->all());

        $valid = $request->validate(
            [
                'site_name' => 'required',
                'title' => 'required|unique:sites,title',
                'href' => 'required',
                'countries_id' => 'nullable',
                'category' => 'required',
                'user_id' => 'required|not_in:""',
                // 'subcategory'   => 'required',
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

            //check count of sites
            $user_id = $request->user_id;
            $res_arr = $this->checksites_count($user_id);
            /*
                        $now = Carbon::now();
                        $packusr = PackageUser::where('user_id', $user_id)->whereDate('expire_date', '>=', $now)->orderByDesc('created_at')->first();

                        $available_sites_count = 0;
                        //   $isfree = 0;
                        $user = User::find($user_id);
                        $used_sites_count = $user->used_sites_count ? $user->used_sites_count : 0;
                        if ($packusr) {
                            $total_sites_count = $packusr->total_sites_count;
                            $used_sites_count = $packusr->used_sites_count;
                            $available_sites_count = $total_sites_count - $used_sites_count;

                        } else {

                            $freepck = Package::where('is_free', 1)->orderByDesc('created_at')->first();
                            $total_sites_count = $freepck->sites_count;
                            $available_sites_count = $total_sites_count - $used_sites_count;
                            //  $isfree = 1;
                        }
                        */
            //   return dd($res_arr);
            if ($res_arr[0] == 0) {
                return redirect()->back()
                    ->with('error', 'انتهى الحد المسموح');
            } else {
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
                        'user_id' => $request->user_id ? $request->user_id : null,
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
                        'latitude' => $request->input('latitude'),
                        'longitude' => $request->input('longitude'),
                        'city_id' => $city_id,
                        'subcity_id' => $subcity_id,
                        'user_id' => $request->user_id ? $request->user_id : 0,
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

                }

                // if ($isfree != 1) {
                //     // $packusr->used_sites_count++;
                //     // $packusr->save();
                // }
                $res_arr[1]->used_sites_count++;
                //$user->used_sites_count++;
                $res_arr[1]->save();
                return redirect()->route('sites.main')
                    ->with('success', 'Successfuly added data');
            }

        }

    }

    public function checksites_count($user_id)
    {
        //check count of sites
        $user_id = $user_id ? $user_id : 0;
        $now = Carbon::now();
        $packusr = PackageUser::where('user_id', $user_id)->whereDate('expire_date', '>=', $now)->orderByDesc('created_at')->first();

        $available_sites_count = 0;
        //   $isfree = 0;
        $user = User::find($user_id);
        $used_sites_count = $user->used_sites_count ? $user->used_sites_count : 0;
        if ($packusr) {
            $total_sites_count = $packusr->total_sites_count;

            $available_sites_count = $total_sites_count - $used_sites_count;

        } else {

            $freepck = Package::where('is_free', 1)->orderByDesc('created_at')->first();
            $total_sites_count = $freepck->sites_count;
            $available_sites_count = $total_sites_count - $used_sites_count;
            //  $isfree = 1;
        }
        $res = 0;
        if ($available_sites_count <= 0) {
            $res = 0;
        } else {
            $res = 1;
        }
        return [$res, $user];
    }
    public function toShowSites()
    {
        $tags = Tag::all();
        $showSites = Sites::where('confirmed', 0)->get();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        return view('dash-board.waiting.waitList', compact('tags', 'showSites', 'country_names'));
        // dd("hello");
    }
    public function apply($id)
    {
        $sitesWithStatusFalse = Sites::find($id);
        // $showallSites = Company::where('status',0)->get();
        // $sitesWithStatusFalse->confirmed = 1;
        Sites::where('id', $id)->select('confirmed')->update(['confirmed' => 1]);
        // $sitesWithStatusFalse->update();
        return redirect()->back();
        // ->with('success' , 'Successfuly updated data');
    }
    public function editWaitSite(Sites $sites, $id)
    {
        $tags = Tag::all();
        $sites = Sites::with('tags')->find($id);
        // $categories = Category::where('parent_id',0)->get();
        $categories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        $scategories = Category::where('parent_id', '!=', 0)->get();
        $countries = Countries::all();

        return view('dash-board.waiting.editSites', compact(['scategories', 'tags', 'sites', 'categories', 'countries']));
    }

    public function updateWaitSite(Request $request, $id)
    {
        $sites = Sites::find($id);
        $request->validate([
            'site_name' => 'required',
            'href' => 'required',
        ]);
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

        if ($sites->countries_id || $sites->subcategories || $sites->category_id) {
            DB::table('sites')->where('id', $id)->update([
                'countries_id' => $request->countries_id,
                'subcategories' => $request->subcategory,
                'category_id' => $request->category
            ]);
        }

        Sites::where('id', $id)->select('confirmed')->update(['confirmed' => 1]);

        $sites->site_name = $request->site_name;
        $sites->href = $request->href;
        $sites->title = $request->title;
        $sites->description = $request->description;
        $sites->articale = $request->articale;

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
        $sites->update();

        return redirect()->route('SitesWait')
            ->with('success', 'Successfuly updated data');

    }
    public function destroyWaitSite($id)
    {
        $sites = Sites::find($id);
        $getSites_id = DB::table('sites_tag')->where('sites_id', $id)->get();
        foreach ($getSites_id as $val) {
            DB::table('tags')->where('id', $val->tag_id)->delete();
        }
        DB::table('sites_tag')->where('sites_id', $id)->delete();
        $sites->delete();
        return redirect()->route('SitesWait')
            ->with('success', 'Successfuly updated data');
    }
    public function edit(Sites $sites, $id)
    {
        $tags = Tag::all();
        $sites = Sites::with('tags')->find($id);
        // $categories = Category::where('parent_id',0)->get();
        $categories = Category::select('id', 'category_name')->where('parent_id', 0)->get();
        $scategories = Category::where('parent_id', '!=', 0)->get();
        $countries = Countries::all();
        $cities = City::all();
        $users = User::select('id', 'email', 'name')->get();
        return view('dash-board.sites.editSites', compact(['cities', 'scategories', 'tags', 'sites', 'categories', 'countries', 'users']));
    }
    public function update(Request $request, $id)
    {
        $sites = Sites::find($id);
        $request->validate([
            'site_name' => 'required',
            'href' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);
        if ($request->logo) {
            $pathImg = str_replace('\\', '/', public_path('picCompany/')) . $sites->logo;

            if (File::exists($pathImg)) {
                File::delete($pathImg);
            }
            $time = time();
            $image = Image::make($request->file('logo')->getRealPath())->encode('webp', 100)->resize(228, 170)->save(public_path('picCompany/' . $time . '.webp'));
            DB::table('sites')->where('id', $id)->update([
                'logo' => $time . '.' . 'webp',
            ]);
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
        $sites->user_id = $request->user_id ? $request->user_id : null;
        $sites->update();
        return redirect()->route('sites.main')
            ->with('success', 'Successfuly updated data');

    }
    public function destroy(Sites $sites, $id)
    {
        $sites = Sites::find($id);
        $user = User::find($sites->user_id);

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
        if ($user) {
            $user->used_sites_count = $user->used_sites_count - 1;
            $user->save();
        }
        // return redirect()->route('sites.main')
        //     ->with('success' , 'Successfuly deleted data');
        return redirect()->back();
    }


}

