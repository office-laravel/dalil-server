<?php

namespace App\Http\Controllers\dalil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Sites;
use App\Models\Adds;
use App\Models\sitting;
use App\Models\Countries;

use App\Models\PinnedPages;
use App\Models\Package;
use Carbon\Carbon;
use App\Models\User;
use App\Models\PackageUser;
class ProductController extends Controller
{

    public function index($site_id)
    {
        $adds = Adds::first();
        $all_pinned_page = PinnedPages::all();
        $DataSittings = sitting::where("id", 1)->first();
        $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();
        $user_id = Auth::check() ? Auth::user()->id : null;
        $site = Sites::find($site_id);
        $products = null;
        if ($user_id) {
            $products = Product::where('site_id', $site_id)->where('user_id', $user_id)->get();
        }
        return view('dalil.product.all', compact(
            'country_names',
            'DataSittings',
            'all_pinned_page',
            'adds',
            'products',
            'site_id',
            'site',
        ));

    }


    public function create($site_id)
    {
        $adds = Adds::first();
        $all_pinned_page = PinnedPages::all();
        $DataSittings = sitting::where("id", 1)->first();
        $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();
        $site = Sites::select('id', 'site_name', 'title', 'user_id')->find($site_id);

        return view('dalil.product.create', compact(
            'country_names',
            'DataSittings',
            'all_pinned_page',
            'adds',
            'site'
        ));
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

            $site = Sites::find($formdata['site_id']);
            $now = Carbon::now();
            $packusr = PackageUser::where('user_id', $site->user_id)->whereDate('expire_date', '>=', $now)->orderByDesc('created_at')->first();

            $available_sites_count = 0;
            $used_products_count = $site->used_products_count ? $site->used_products_count : 0;

            if ($packusr) {
                $total_products_count = $packusr->products_count;
                //  $used_products_count = $packusr->used_sites_count;
                $available_sites_count = $total_products_count - $used_products_count;
            } else {

                $freepck = Package::where('is_free', 1)->orderByDesc('created_at')->first();
                $total_products_count = $freepck->products_count;
                $available_sites_count = $total_products_count - $used_products_count;
                //  $isfree = 1;
            }
            if ($available_sites_count <= 0) {
                return response()->json("no-limit");
            } else {
                $newObj = new Product();
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

        $product = Product::with('site')->find($id);
        $related_products = Product::where('site_id', $product->site_id)->where('id', '!=', $product->id)->orderByDesc('sequence')->get();
        // dd($ff);
        return view('dalil.product.product-describtion', compact([
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

        $product = Product::find($id);
        $site = Sites::select('id', 'site_name', 'title', 'user_id')->find($product->site_id);
        return view('dalil.product.edit', compact(
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


            $newObj = Product::find($id);
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

        $object = Product::find($id);

        if (!($object === null)) {
            $pathImg = str_replace('\\', '/', public_path('picProduct/')) . $object->image;

            if (File::exists($pathImg)) {
                File::delete($pathImg);
            }
            $site = Sites::find($object->site_id);

            Product::find($id)->delete();
            //decrease used product
            $site->used_products_count--;
        }
        return redirect()->back();
        // return  $this->index();
        //   return redirect()->route('users.index');

    }

    // Admin Methods //////////////////////////////////////////////////////////////////
    public function admin_index($site_id)
    {
        $adds = Adds::first();
        $all_pinned_page = PinnedPages::all();
        $DataSittings = sitting::where("id", 1)->first();
        $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();

        $site = Sites::find($site_id);


        $products = Product::where('site_id', $site_id)->get();

        return view('dash-board.product.all', compact(
            'country_names',
            'DataSittings',
            'all_pinned_page',
            'adds',
            'products',
            'site_id',
            'site',
        ));

    }


    public function admin_create($site_id)
    {
        $adds = Adds::first();
        $all_pinned_page = PinnedPages::all();
        $DataSittings = sitting::where("id", 1)->first();
        $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();
        $site = Sites::select('id', 'site_name', 'title', 'user_id')->find($site_id);

        return view('dash-board.product.create', compact(
            'country_names',
            'DataSittings',
            'all_pinned_page',
            'adds',
            'site'
        ));
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
            //  $user_id = $request->user_id ? $request->user_id : 0;
            $site = Sites::find($formdata['site_id']);
            $now = Carbon::now();
            $packusr = PackageUser::where('user_id', $site->user_id)->whereDate('expire_date', '>=', $now)->orderByDesc('created_at')->first();

            $available_sites_count = 0;
            $used_products_count = $site->used_products_count ? $site->used_products_count : 0;

            if ($packusr) {
                $total_products_count = $packusr->products_count;
                //  $used_products_count = $packusr->used_sites_count;
                $available_sites_count = $total_products_count - $used_products_count;
            } else {

                $freepck = Package::where('is_free', 1)->orderByDesc('created_at')->first();
                $total_products_count = $freepck->products_count;
                $available_sites_count = $total_products_count - $used_products_count;
                //  $isfree = 1;
            }
            if ($available_sites_count <= 0) {
                return response()->json("no-limit");
            } else {
                $newObj = new Product();
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
                $site->used_products_count++;
                $site->save();

                return response()->json("ok");
            }
        }

    }

    public function admin_showby_id($id)
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

        $product = Product::with('site')->find($id);
        $related_products = Product::where('site_id', $product->site_id)->where('id', '!=', $product->id)->orderByDesc('sequence')->get();
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
        $adds = Adds::first();
        $all_pinned_page = PinnedPages::all();
        $DataSittings = sitting::where("id", 1)->first();
        $country_names = Countries::select('id', 'country_flag', 'country_name', 'href')->get();

        $product = Product::find($id);
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


    public function admin_update(Request $request, $id)
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


            $newObj = Product::find($id);
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
    public function admin_destroy($id)
    {

        $object = Product::find($id);
        if (!($object === null)) {
            $pathImg = str_replace('\\', '/', public_path('picProduct/')) . $object->image;

            if (File::exists($pathImg)) {
                File::delete($pathImg);
            }

            $site = Sites::find($object->site_id);
            Product::find($id)->delete();
            //decrease used product
            $site->used_products_count--;
        }
        return redirect()->back();
        // return  $this->index();
        //   return redirect()->route('users.index');

    }

}
