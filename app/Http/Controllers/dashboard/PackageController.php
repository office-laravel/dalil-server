<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Duration;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\DurationPackage;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\sitting;
use App\Models\Countries;
use App\Models\City;
use App\Models\PinnedPages;
use Illuminate\Support\Str;
class PackageController extends Controller
{
  /**
   * Display a listing of the resource.
   */

  public function index()
  {
    $packages = Package::get();

    return view('dash-board.package.all', compact('packages'));
  }




  public function create()
  {

    $durations = Duration::get();
    return view('dash-board.package.create', compact('durations'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function store(Request $request)
  {

    $formdata = $request->all();
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required',
        'code' => 'required',
      ],
      [
        'code.*' => 'هذا الحقل مطلوب',
        'name.*' => 'هذا الحقل مطلوب',
      ]
    );

    if ($validator->fails()) {

      return response()->json(['errors' => $validator->errors()], 422);
    } else {
      // $d =explode(',' ,$request->countries);


      $newObj = new Package();
      $newObj->name = $formdata['name'];
      $newObj->code = $formdata['code'];
      $newObj->href = isset($formdata['href']) ? 1 : 0;
      $newObj->category = isset($formdata['category']) ? 1 : 0;
      $newObj->title = isset($formdata['title']) ? 1 : 0;
      $newObj->logo = isset($formdata['logo']) ? 1 : 0;
      $newObj->mobile_number = isset($formdata['mobile_number']) ? 1 : 0;
      $newObj->phone_number = isset($formdata['phone_number']) ? 1 : 0;
      $newObj->video = isset($formdata['video']) ? 1 : 0;
      $newObj->description = isset($formdata['description']) ? 1 : 0;
      $newObj->articale = isset($formdata['articale']) ? 1 : 0;
      $newObj->subcategories = isset($formdata['subcategories']) ? 1 : 0;
      $newObj->keyword = isset($formdata['keyword']) ? 1 : 0;
      $newObj->social = isset($formdata['social']) ? 1 : 0;
      $newObj->android = isset($formdata['android']) ? 1 : 0;
      $newObj->ios = isset($formdata['ios']) ? 1 : 0;

      //  $newObj->priority = isset($formdata['priority']) ? 1 : 0;
      $newObj->maploc = isset($formdata['map']) ? 1 : 0;
      $newObj->city = isset($formdata['city']) ? 1 : 0;

      $newObj->sites_count = $formdata['sites_count'];
      $newObj->products_count = $formdata['products_count'];
      // $newObj->price = $formdata['price'];
      $newObj->is_free = isset($formdata['is_free']) ? 1 : 0;
      $newObj->status = isset($formdata['status']) ? 1 : 0;


      //  $newObj->category_p_id = $formdata['category_p_id'];

      $newObj->save();
      $year_price_arr = json_decode($formdata['year_price'], true);

      // حفظ البيانات في قاعدة البيانات
      foreach ($year_price_arr as $item) {
        DurationPackage::create([
          'duration_id' => $item['year'],
          'package_id' => $newObj->id,
          'price' => $item['price'],
          'status' => 1,
        ]);
      }


      // if ($request->hasFile('image')) {
      //   $time = $newObj->id . time() . '.webp';
      //   // $ext = $request->file('image')->getClientOriginalExtension();
      //   Image::make($request->file('image')->getRealPath())->encode('webp', 100)->resize(100, 60)->save(public_path('picProduct/' . $time));
      //   // $newImageName = time(). '.' . $request->photo->extension();
      //   $newObj->image = $time;
      //   $newObj->update();
      // }

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


  public function edit($id)
  {

    $package = Package::with(['durationspackages:id,duration_id,package_id,status,price', 'durationspackages.duration:id,duration'])->find($id);
    $durations = Duration::get();
    return view('dash-board.package.edit', compact(
      'package',
      'durations',

    ));
  }


  public function update(Request $request, $id)
  {
    $formdata = $request->all();
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required',
        'code' => 'required',
      ],
      [
        'code.*' => 'هذا الحقل مطلوب',
        'name.*' => 'هذا الحقل مطلوب',
      ]
    );

    if ($validator->fails()) {

      return response()->json(['errors' => $validator->errors()], 422);
    } else {
      // $d =explode(',' ,$request->countries);


      $newObj = Package::find($id);
      $newObj->name = $formdata['name'];
      $newObj->code = $formdata['code'];
      $newObj->href = isset($formdata['href']) ? 1 : 0;
      $newObj->category = isset($formdata['category']) ? 1 : 0;
      $newObj->title = isset($formdata['title']) ? 1 : 0;
      $newObj->logo = isset($formdata['logo']) ? 1 : 0;
      $newObj->mobile_number = isset($formdata['mobile_number']) ? 1 : 0;
      $newObj->phone_number = isset($formdata['phone_number']) ? 1 : 0;
      $newObj->video = isset($formdata['video']) ? 1 : 0;
      $newObj->description = isset($formdata['description']) ? 1 : 0;
      $newObj->articale = isset($formdata['articale']) ? 1 : 0;
      $newObj->subcategories = isset($formdata['subcategories']) ? 1 : 0;
      $newObj->keyword = isset($formdata['keyword']) ? 1 : 0;
      $newObj->social = isset($formdata['social']) ? 1 : 0;
      $newObj->android = isset($formdata['android']) ? 1 : 0;
      $newObj->ios = isset($formdata['ios']) ? 1 : 0;

      //  $newObj->priority = isset($formdata['priority']) ? 1 : 0;
      $newObj->maploc = isset($formdata['map']) ? 1 : 0;
      $newObj->city = isset($formdata['city']) ? 1 : 0;

      $newObj->sites_count = $formdata['sites_count'];
      $newObj->products_count = $formdata['products_count'];
      // $newObj->price = $formdata['price'];
      $newObj->is_free = isset($formdata['is_free']) ? 1 : 0;
      $newObj->status = isset($formdata['status']) ? 1 : 0;


      //  $newObj->category_p_id = $formdata['category_p_id'];

      $newObj->save();

      $year_price_arr = json_decode($formdata['year_price'], true);
      //delete
      $durationids = data_get($year_price_arr, '*.year');
      DurationPackage::where('package_id', $newObj->id)->whereIntegerNotInRaw('duration_id', $durationids)->delete();
      //updateOrCreate
      foreach ($year_price_arr as $item) {
        $duration_id = $item['year'];
        $durationp = DurationPackage::updateOrCreate(
          ['duration_id' => $duration_id, 'package_id' => $newObj->id],
          ['price' => $item['price'], 'status' => 1]
        );
      }

      // if ($request->hasFile('image')) {
      //   $time = $newObj->id . time() . '.webp';
      //   // $ext = $request->file('image')->getClientOriginalExtension();
      //   Image::make($request->file('image')->getRealPath())->encode('webp', 100)->resize(100, 60)->save(public_path('picProduct/' . $time));
      //   // $newImageName = time(). '.' . $request->photo->extension();
      //   $newObj->image = $time;
      //   $newObj->update();
      // }

      return response()->json("ok");

    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {

    $object = Package::find($id);

    if (!($object === null)) {
      //  $pathImg = str_replace('\\', '/', public_path('picProduct/')) . $object->image;

      // if (File::exists($pathImg)) {
      //   File::delete($pathImg);
      // }
      DurationPackage::where('package_id', $object->id)->delete();
      Package::find($id)->delete();

    }
    return redirect()->back();
    // return  $this->index();
    //   return redirect()->route('users.index');

  }
  public function user_index()
  {
    $packages = Package::with(['durationspackages:id,duration_id,package_id,status,price', 'durationspackages.duration:id,duration'])->orderByDesc('is_free')->orderBy('price')->get();
    $Settings = sitting::first();
    $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();

    return view('dalil.package.all', compact('packages', 'country_names'));
  }




  public function user_create()
  {

    $durations = Duration::get();
    return view('dash-board.package.create', compact('durations'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function user_store(Request $request)
  {

    $formdata = $request->all();
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required',
        'code' => 'required',
      ],
      [
        'code.*' => 'هذا الحقل مطلوب',
        'name.*' => 'هذا الحقل مطلوب',
      ]
    );

    if ($validator->fails()) {

      return response()->json(['errors' => $validator->errors()], 422);
    } else {
      // $d =explode(',' ,$request->countries);


      $newObj = new Package();
      $newObj->name = $formdata['name'];
      $newObj->code = $formdata['code'];
      $newObj->href = isset($formdata['href']) ? 1 : 0;
      $newObj->category = isset($formdata['category']) ? 1 : 0;
      $newObj->title = isset($formdata['title']) ? 1 : 0;
      $newObj->logo = isset($formdata['logo']) ? 1 : 0;
      $newObj->mobile_number = isset($formdata['mobile_number']) ? 1 : 0;
      $newObj->phone_number = isset($formdata['phone_number']) ? 1 : 0;
      $newObj->video = isset($formdata['video']) ? 1 : 0;
      $newObj->description = isset($formdata['description']) ? 1 : 0;
      $newObj->articale = isset($formdata['articale']) ? 1 : 0;
      $newObj->subcategories = isset($formdata['subcategories']) ? 1 : 0;
      $newObj->keyword = isset($formdata['keyword']) ? 1 : 0;
      $newObj->social = isset($formdata['social']) ? 1 : 0;
      $newObj->android = isset($formdata['android']) ? 1 : 0;
      $newObj->ios = isset($formdata['ios']) ? 1 : 0;

      //  $newObj->priority = isset($formdata['priority']) ? 1 : 0;
      $newObj->maploc = isset($formdata['map']) ? 1 : 0;
      $newObj->city = isset($formdata['city']) ? 1 : 0;

      $newObj->sites_count = $formdata['sites_count'];
      $newObj->products_count = $formdata['products_count'];
      // $newObj->price = $formdata['price'];
      $newObj->is_free = isset($formdata['is_free']) ? 1 : 0;
      $newObj->status = isset($formdata['status']) ? 1 : 0;


      //  $newObj->category_p_id = $formdata['category_p_id'];

      $newObj->save();
      $year_price_arr = json_decode($formdata['year_price'], true);

      // حفظ البيانات في قاعدة البيانات
      foreach ($year_price_arr as $item) {
        DurationPackage::create([
          'duration_id' => $item['year'],
          'package_id' => $newObj->id,
          'price' => $item['price'],
          'status' => 1,
        ]);
      }


      // if ($request->hasFile('image')) {
      //   $time = $newObj->id . time() . '.webp';
      //   // $ext = $request->file('image')->getClientOriginalExtension();
      //   Image::make($request->file('image')->getRealPath())->encode('webp', 100)->resize(100, 60)->save(public_path('picProduct/' . $time));
      //   // $newImageName = time(). '.' . $request->photo->extension();
      //   $newObj->image = $time;
      //   $newObj->update();
      // }

      return response()->json("ok");

    }

  }


}
