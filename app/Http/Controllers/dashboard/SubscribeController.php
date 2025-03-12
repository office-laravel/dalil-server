<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\DurationPackage;
use App\Models\PackageUser;
use App\Models\Sites;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SubscribeController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $List = Package::get();
    return view('dash-board.package.all', ['List' => $List]);
  }
  public function admin_index()
  {
    $packageusers = PackageUser::where('status','!=','w')->orderByDesc('created_at')->get();
    return view('dash-board.package-subscribe.all', compact('packageusers'));
    ;
  }


  public function duration_byid($id)
  {
    // $adds = Adds::first();
    // $all_pinned_page = PinnedPages::all();
    //  $DataSittings = sitting::where("id", 1)->first();
    //   $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();
    // $site = Sites::select('id', 'site_name', 'title', 'user_id')->find($site_id);
    $durations = DurationPackage::with('duration:id,duration')->where('package_id', $id)->select(
      'id',
      'duration_id',
      'package_id',
      'price',
    )->get()->sortBy('duration.duration');

    return response()->json($durations);
  }
  public function admin_create()
  {
    // $adds = Adds::first();
    // $all_pinned_page = PinnedPages::all();
    //  $DataSittings = sitting::where("id", 1)->first();
    //   $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();
    // $site = Sites::select('id', 'site_name', 'title', 'user_id')->find($site_id);
    $users = User::get();
    $packages = Package::where('status', '1')->where('is_free', '!=', 1)->get();
    return view('dash-board.package-subscribe.create', compact('users', 'packages'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function admin_store(Request $request)
  {

    $formdata = $request->all();
    $validator = Validator::make(
      $request->all(),
      [

        'user_id' => 'required|not_in:0',

        'package_id' => 'required|not_in:0',
        'year' => 'required|not_in:0',
      ],
      [
        'user_id.*' => 'هذا الحقل مطلوب',
        'package_id.*' => 'هذا الحقل مطلوب',
        'year.*' => 'هذا الحقل مطلوب',
      ]
    );

    if ($validator->fails()) {

      return response()->json(['errors' => $validator->errors()], 422);
    } else {
      // $d =explode(',' ,$request->countries);
      $now = Carbon::now()->format('Y-m-d');

      $package = Package::find($formdata['package_id']);
      $duration_p = DurationPackage::with('duration')->find($formdata['year']);
      $newObj = new PackageUser();
      $newObj->user_id = $formdata['user_id'];
      $newObj->package_id = $formdata['package_id'];
      $newObj->total_sites_count = $package->sites_count;
      $newObj->used_sites_count = 0;
      $newObj->name = $package->name;
      $newObj->code = $package->code;
      $newObj->href = $package->href;
      $newObj->category = $package->category;
      $newObj->title = $package->title;
      $newObj->logo = $package->logo;
      $newObj->mobile_number = $package->mobile_number;
      $newObj->phone_number = $package->phone_number;
      $newObj->video = $package->video;
      $newObj->description = $package->description;
      $newObj->articale = $package->articale;
      $newObj->subcategories = $package->subcategories;
      $newObj->keyword = $package->keyword;
      $newObj->social = $package->social;
      $newObj->android = $package->android;
      $newObj->ios = $package->ios;
      $newObj->views = $package->views;
      $newObj->priority = $package->priority;
      $newObj->maploc = $package->maploc;
      $newObj->city = $package->city;
      $newObj->sites_count = $package->sites_count;
      $newObj->products_count = $package->products_count;
      $newObj->price = $duration_p->price;
      $newObj->is_free = $package->is_free;
      $newObj->duration = $duration_p->duration->duration;
      $newObj->start_date = $now;
      $newObj->expire_date = Carbon::parse($now)->addYears($duration_p->duration->duration);
      $newObj->duration_id = $duration_p->duration_id;
      $newObj->duration_package_id = $duration_p->id;
      $newObj->status ='a'; 
      $newObj->save();
      //update sites with new package_user_id
      Sites::where('user_id', $newObj->user_id)->update(['package_user_id' => $newObj->id]);
      return response()->json("ok");

    }

  }

  public function showby_id($id)
  {
    $adds = Adds::first();
    $Settings = sitting::first();
    //   $get_site_descr = Sites::with(['country', 'category', 'tags'])->where('id', $id)->where('confirmed', 1)->get();
    // dd($get_site_descr);
    $get_categoryTo_descr = Sites::with(['country', 'category', 'subcategory', 'city', 'subcity'])->select(
      'id',
      'category_id',
      'countries_id',
      'title',
      'subcategories',
      'city_id',
      'subcity_id',
      'user_id',
    )->where('id', $id)->where('confirmed', 1)->first();

    $addss = Adds::select('atTop', 'atRight', 'otherSite', 'atHead')->first();
    $is_setTags = Sites::with('tags')->where('id', $id)->first();


    $Sites = Sites::find($id);
    //  $country_id = $Sites->country_id;
    $is_SetCountry = Countries::select('id', 'country_name', 'href', 'country_flag')->where('href', 'Syria')->first();

    $country_names = Countries::select('id', 'country_name', 'country_flag', 'href')->get();
    $all_pinned_page = PinnedPages::get();

    $product = Package::with('site')->find($id);
    $related_products = Package::where('site_id', $product->site_id)->where('id', '!=', $product->id)->orderByDesc('sequence')->get();
    // dd($ff);
    return view('dash-board.product.product-describtion', compact([
      'adds',
      'Settings',
      'addss',
      'country_names',
      'all_pinned_page',
      'is_SetCountry',
      'product',
      'related_products'
    ]));
    // return view('dalil.describtion' , compact([ 'scategories' ,'addss','get_site_descrr','country_namess','get_about_waslat','get_SupCategory','get_categoryTo_descr','title_descr','DataSittings' , 'country_names' , 'all_pinned_page' , 'get_site_descr']));

  }


  public function admin_edit($id)
  {
    $users = User::get();
    $packages = Package::where('status', '1')->where('is_free', '!=', 1)->get();
    $subscribe = PackageUser::find($id);
    return view('dash-board.package-subscribe.edit', compact('users', 'packages', 'subscribe'));
  }


  public function admin_update(Request $request, $id)
  {
    $formdata = $request->all();
    $validator = Validator::make(
      $request->all(),
      [

        'user_id' => 'required|not_in:0',

        'package_id' => 'required|not_in:0',
        'year' => 'required|not_in:0',
      ],
      [
        'user_id.*' => 'هذا الحقل مطلوب',
        'package_id.*' => 'هذا الحقل مطلوب',
        'year.*' => 'هذا الحقل مطلوب',
      ]
    );

    if ($validator->fails()) {

      return response()->json(['errors' => $validator->errors()], 422);
    } else {
      // $d =explode(',' ,$request->countries);
      $now = Carbon::now()->format('Y-m-d');

      $package = Package::find($formdata['package_id']);
      $duration_p = DurationPackage::with('duration')->find($formdata['year']);
      $newObj = PackageUser::find($id);
      $newObj->user_id = $formdata['user_id'];
      $newObj->package_id = $formdata['package_id'];
      $newObj->total_sites_count = $package->sites_count;
      $newObj->used_sites_count = 0;
      $newObj->name = $package->name;
      $newObj->code = $package->code;
      $newObj->href = $package->href;
      $newObj->category = $package->category;
      $newObj->title = $package->title;
      $newObj->logo = $package->logo;
      $newObj->mobile_number = $package->mobile_number;
      $newObj->phone_number = $package->phone_number;
      $newObj->video = $package->video;
      $newObj->description = $package->description;
      $newObj->articale = $package->articale;
      $newObj->subcategories = $package->subcategories;
      $newObj->keyword = $package->keyword;
      $newObj->social = $package->social;
      $newObj->android = $package->android;
      $newObj->ios = $package->ios;
      $newObj->views = $package->views;
      $newObj->priority = $package->priority;
      $newObj->maploc = $package->maploc;
      $newObj->city = $package->city;
      $newObj->sites_count = $package->sites_count;
      $newObj->products_count = $package->products_count;
      $newObj->price = $duration_p->price;
      $newObj->is_free = $package->is_free;
      $newObj->duration = $duration_p->duration->duration;
      $newObj->start_date = $now;
      $newObj->expire_date = Carbon::parse($now)->addYears($duration_p->duration->duration);
      $newObj->duration_id = $duration_p->duration_id;
      $newObj->duration_package_id = $duration_p->id;
      if(isset($formdata['status'])){
        $package_user_id=null;
        $newObj->status = $formdata['status'];
        if($formdata['status']=='a'){
          $package_user_id=$newObj->id;
        } 
        Sites::where('user_id', $newObj->user_id)->update(['package_user_id' => $package_user_id]);
    
      }
      $newObj->save();
      return response()->json("ok");

    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function admin_destroy($id)
  {

    $object = PackageUser::find($id);

    if (!($object === null)) {
      // $pathImg = str_replace('\\', '/', public_path('picProduct/')) . $object->image;

      // if (File::exists($pathImg)) {
      //   File::delete($pathImg);
      // }
      Sites::where('package_user_id', $object->id)->update(['package_user_id' => null]);
      PackageUser::find($id)->delete();

    }
    return redirect()->back();
    // return  $this->index();
    //   return redirect()->route('users.index');

  }
  public function user_store(Request $request)
  {
    if( Auth::check() ) {
    $formdata = $request->all();
    $validator = Validator::make(
      $request->all(),
      [
      //  'user_id' => 'required|not_in:0',
        'package' => 'required|not_in:0',
       // 'year' => 'required|not_in:0',
      ],
      [
      //  'user_id.*' => 'هذا الحقل مطلوب',
        'package.*' => 'هذا الحقل مطلوب',
       // 'year.*' => 'هذا الحقل مطلوب',
      ]
    );

    if ($validator->fails()) {
     // return response()->json(['errors' => $validator->errors()], 422);
      return redirect()->back()->with('errors' , $validator->errors());
    } else {
      $year_field_name='year-'.$formdata['package'];
      $year_id=null;
      if(isset($formdata[$year_field_name])){
        $year_id=$formdata[$year_field_name];
      }    

      $res=$this->subscribe_store(Auth::user()->id,$formdata['package'], $year_id);
      if( $res==1){
        return redirect()->route('site.home')
        ->with('success' , 'تم تسجيل الاشتراك بانتظار موافقة الادارة');
      }else{
        return redirect()->route('site.home')
        ->with('error' , 'لم تنجح العملية');
      }
    
     
    }
  }else{
    return redirect()->route('loginu');
  }

  }

  //
  public function subscribe_store($user_id,$package_id, $year_id)
  {
   
    /*
    $validator = Validator::make(
      $request->all(),
      [
      //  'user_id' => 'required|not_in:0',
        'package' => 'required|not_in:0',
       // 'year' => 'required|not_in:0',
      ],
      [
      //  'user_id.*' => 'هذا الحقل مطلوب',
        'package.*' => 'هذا الحقل مطلوب',
       // 'year.*' => 'هذا الحقل مطلوب',
      ]
    );
*/
 
      // $d =explode(',' ,$request->countries);
      $now = Carbon::now()->format('Y-m-d');
      $package = Package::find($package_id);
     // $year_field_name='year-'.$package_id;
     // $year_id=$formdata[$year_field_name];
   
      $newObj = new PackageUser();
      $newObj->user_id = $user_id;
      $newObj->package_id = $package_id;
      $newObj->total_sites_count = $package->sites_count;
      $newObj->used_sites_count = 0;
      $newObj->name = $package->name;
      $newObj->code = $package->code;
      $newObj->href = $package->href;
      $newObj->category = $package->category;
      $newObj->title = $package->title;
      $newObj->logo = $package->logo;
      $newObj->mobile_number = $package->mobile_number;
      $newObj->phone_number = $package->phone_number;
      $newObj->video = $package->video;
      $newObj->description = $package->description;
      $newObj->articale = $package->articale;
      $newObj->subcategories = $package->subcategories;
      $newObj->keyword = $package->keyword;
      $newObj->social = $package->social;
      $newObj->android = $package->android;
      $newObj->ios = $package->ios;
      $newObj->views = $package->views;
      $newObj->priority = $package->priority;
      $newObj->maploc = $package->maploc;
      $newObj->city = $package->city;
      $newObj->sites_count = $package->sites_count;
      $newObj->products_count = $package->products_count;
      $newObj->is_free = $package->is_free;

      if($package->is_free!=1){
        $duration_p = DurationPackage::with('duration')->find($year_id);
        $newObj->price = $duration_p->price;
      
        $newObj->duration = $duration_p->duration->duration;
       // $newObj->start_date = $now;
      //  $newObj->expire_date = Carbon::parse($now)->addYears($duration_p->duration->duration);
  
        $newObj->duration_id = $duration_p->duration_id;
        $newObj->duration_package_id = $duration_p->id;
        $newObj->status ='w';  
      }else{
        $newObj->status ='a';  
      }  
     
      $newObj->save();
  
      //update sites with new package_user_id
   //   Sites::where('user_id', $newObj->user_id)->update(['package_user_id' => $newObj->id]);
     // return response()->json("ok");
         return  1;
  

  }

  // admin wait orders

 
  public function admin_index_wait()
  {
    $packageusers = PackageUser::orderByDesc('created_at')->where('status','w')->get();
    return view('dash-board.package-subscribe-wait.all', compact('packageusers'));
   
  }

  public function admin_edit_wait($id)
  {
  //  $users = User::get();
 //   $packages = Package::where('status', '1')->where('is_free', '!=', 1)->get();
    $subscribe = PackageUser::with(['package','user'])->find($id);
  //  $user = User::find($subscribe->user_id);
    return view('dash-board.package-subscribe-wait.edit', compact('subscribe'));
  }


  public function admin_update_wait(Request $request, $id)
  {
    $formdata = $request->all();
    $validator = Validator::make(
      $request->all(),
      [
        'status' => 'required|not_in:0',    
      ],
      [
        'status.*' => 'هذا الحقل مطلوب',       
      ]
    );

    if ($validator->fails()) {

      return response()->json(['errors' => $validator->errors()], 422);
    } else {
      // $d =explode(',' ,$request->countries);
      $now = Carbon::now()->format('Y-m-d');

    //  $package = Package::find($formdata['package_id']);
    //  $duration_p = DurationPackage::with('duration')->find($formdata['year']);
      $newObj = PackageUser::find($id);
 
     // $newObj->package_id = $formdata['package_id'];
      // $newObj->total_sites_count = $package->sites_count;
      // $newObj->used_sites_count = 0;
      // $newObj->name = $package->name;
      // $newObj->code = $package->code;
      // $newObj->href = $package->href;
      // $newObj->category = $package->category;
      // $newObj->title = $package->title;
      // $newObj->logo = $package->logo;
      // $newObj->mobile_number = $package->mobile_number;
      // $newObj->phone_number = $package->phone_number;
      // $newObj->video = $package->video;
      // $newObj->description = $package->description;
      // $newObj->articale = $package->articale;
      // $newObj->subcategories = $package->subcategories;
      // $newObj->keyword = $package->keyword;
      // $newObj->social = $package->social;
      // $newObj->android = $package->android;
      // $newObj->ios = $package->ios;
      // $newObj->views = $package->views;
      // $newObj->priority = $package->priority;
      // $newObj->maploc = $package->maploc;
      // $newObj->city = $package->city;
      // $newObj->sites_count = $package->sites_count;
      // $newObj->products_count = $package->products_count;
      // $newObj->price = $duration_p->price;
      // $newObj->is_free = $package->is_free;
      // $newObj->duration = $duration_p->duration->duration;
     
      if(isset($formdata['status'])){
        $package_user_id=null;
        $newObj->status = $formdata['status'];
        if($formdata['status']=='a'){
          $newObj->start_date = $now;
          $newObj->expire_date = Carbon::parse($now)->addYears($newObj->duration);
          $package_user_id=$newObj->id;

       
        } 
        Sites::where('user_id', $newObj->user_id)->update(['package_user_id' => $package_user_id]);
      
      }
     
     // $newObj->duration_id = $duration_p->duration_id;
     // $newObj->duration_package_id = $duration_p->id;
     $newObj->status =$formdata['status']; 
      $newObj->save();
      return response()->json("ok");

    }
  }

 
}
