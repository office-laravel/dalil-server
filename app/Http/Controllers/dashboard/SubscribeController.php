<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\DurationPackage;
use App\Models\PackageUser;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
    $packageusers = PackageUser::orderByDesc('created_at')->get();
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
    $packages = Package::where('status', '1')->get();
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
    /*
'name',
    'type',
    'description',
    'image',
    'price',
    'unit',
    'status',
    'sequence',
    'tag',
    'site_id',
    'user_id',
    'category_p_id',
*/
    $formdata = $request->all();
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required',
        'type' => 'required|not_in:0|in:p,s',

        'price' => 'nullable|numeric',
        'sequence' => 'nullable|integer',
      ],
      [
        'type.*' => 'هذا الحقل مطلوب',
        'name.*' => 'هذا الحقل مطلوب',
      ]
    );

    if ($validator->fails()) {

      return response()->json(['errors' => $validator->errors()], 422);
    } else {
      // $d =explode(',' ,$request->countries);


      $newObj = new Package();
      $newObj->name = $formdata['name'];
      $newObj->type = $formdata['type'];
      $newObj->description = $formdata['description'];

      $newObj->price = $formdata['price'];
      $newObj->currency = $formdata['currency'];
      $newObj->unit = $formdata['unit'];
      $newObj->status = 'wait';
      $newObj->sequence = $formdata['sequence'];
      // $newObj->tag = $formdata['tag'];
      $newObj->site_id = $formdata['site_id'];
      $newObj->user_id = Auth::check() ? Auth::user()->id : null;
      //  $newObj->category_p_id = $formdata['category_p_id'];

      $newObj->save();

      if ($request->hasFile('image')) {
        $time = $newObj->id . time() . '.webp';
        // $ext = $request->file('image')->getClientOriginalExtension();
        Image::make($request->file('image')->getRealPath())->encode('webp', 100)->resize(100, 60)->save(public_path('picProduct/' . $time));
        // $newImageName = time(). '.' . $request->photo->extension();
        $newObj->image = $time;
        $newObj->update();
      }

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
    $adds = Adds::first();
    $all_pinned_page = PinnedPages::all();
    $DataSittings = sitting::where("id", 1)->first();
    $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();

    $product = Package::find($id);
    $site = Sites::select('id', 'site_name', 'title', 'user_id')->find($product->site_id);
    return view('dash-board.product.edit', compact(
      'country_names',
      'DataSittings',
      'all_pinned_page',
      'adds',
      'site',
      'product',
    ));
  }


  public function update(Request $request, $id)
  {
    $formdata = $request->all();
    $validator = Validator::make(
      $request->all(),
      [
        'name' => 'required',
        'type' => 'required|not_in:0|in:p,s',

        'price' => 'nullable|numeric',
        'sequence' => 'nullable|integer',
      ],
      [
        'type.*' => 'هذا الحقل مطلوب',
        'name.*' => 'هذا الحقل مطلوب',
      ]
    );

    if ($validator->fails()) {

      return response()->json(['errors' => $validator->errors()], 422);
    } else {
      // $d =explode(',' ,$request->countries);


      $newObj = Package::find($id);
      $newObj->name = $formdata['name'];
      $newObj->type = $formdata['type'];
      $newObj->description = $formdata['description'];

      $newObj->price = $formdata['price'];
      $newObj->currency = $formdata['currency'];
      $newObj->unit = $formdata['unit'];
      $newObj->status = 'wait';
      $newObj->sequence = $formdata['sequence'];
      // $newObj->tag = $formdata['tag'];
      $newObj->site_id = $formdata['site_id'];
      $newObj->user_id = Auth::check() ? Auth::user()->id : null;
      //  $newObj->category_p_id = $formdata['category_p_id'];

      $newObj->save();

      if ($request->hasFile('image')) {

        $pathImg = str_replace('\\', '/', public_path('picProduct/')) . $newObj->image;

        if (File::exists($pathImg)) {
          File::delete($pathImg);
        }

        $time = $newObj->id . time() . '.webp';
        // $ext = $request->file('image')->getClientOriginalExtension();
        Image::make($request->file('image')->getRealPath())->encode('webp', 100)->resize(100, 60)->save(public_path('picProduct/' . $time));
        // $newImageName = time(). '.' . $request->photo->extension();
        $newObj->image = $time;
        $newObj->update();
      }

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
      $pathImg = str_replace('\\', '/', public_path('picProduct/')) . $object->image;

      if (File::exists($pathImg)) {
        File::delete($pathImg);
      }
      Package::find($id)->delete();

    }
    return redirect()->back();
    // return  $this->index();
    //   return redirect()->route('users.index');

  }


}
