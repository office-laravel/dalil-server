<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Countries;
use App\Models\Sites;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $showCategory = Category::latest()->get();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        return view('dash-board.categories.showallCategories', compact('showCategory', 'country_names'));
    }

    public function getCategorWithCountry($count_id)
    {
        $country_namess = Countries::select('id', 'country_name', 'country_flag', 'href')->where('id', $count_id)->first();
        $category_show = Category::with('country')->where('country_id', $count_id)->get();
        $country_names = Countries::select('id', 'country_name', 'href', 'country_flag')->get();
        return view('dash-board.categories.showallCategories', compact('category_show', 'country_names', 'country_namess'));
    }
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        $countries = Countries::all();
        // $categories = Category::where('parent_id' , '==',0)->get();
        // $supcategories = Category::where('parent_id' , '!=',0)->get();
        // $categories = DB::table('categories')->get();
        // $categories = Category::all();
        return view('dash-board.categories.createCategories', compact('categories', 'countries'));
    }

    public function getCate(Request $request)
    {
        $country_id = $request->country_id;
        // dd($parent_id);
        $getCatt = Category::where('country_id', $country_id)
            ->where('parent_id', 0)
            ->get();
        // return $getCatt;
        return response()->json(['getCatt' => $getCatt]);
    }

    public function supCate(Request $request)
    {
        $parent_id = $request->cat_id;

        $supcategories = Category::where('id', $parent_id)
            ->with('supcategories')
            ->get();
        // return $supcategories;
        return response()->json(['supcategories' => $supcategories]);
    }



    public function store(Request $request)
    {


        $request->validate([
            'category_name' => 'required',
            // 'href'           => 'unique:categories,href',
            'title' => 'required',
            'visible_status' => 'required'
        ]);
        // $d =explode(',' ,$request->countries);
        $mydataCreated = null;
        if ($request->hasFile('image')) {
            $time = time();
            Image::make($request->file('image')->getRealPath())->encode('webp', 100)->resize(100, 60)->save(public_path('PicCate/' . $time . '.webp'));
            // $newImageName = time(). '.' . $request->photo->extension();

            $mydataCreated = Category::create([
                'category_name' => $request->input('category_name'),
                'href' => $request->input('href'),
                'title' => $request->input('title'),
                'keywords' => $request->input('keywords'),
                'visible_status' => $request->visible_status ? '1' : '0',
                'parent_id' => $request->category ? $request->category : 0, // or Null
                'image' => $time . '.' . 'webp',
            ]);
        } else {
            $time = Null;
            $mydataCreated = Category::create([
                'category_name' => $request->input('category_name'),
                'href' => $request->input('href'),
                'title' => $request->input('title'),
                'keywords' => $request->input('keywords'),
                'image' => $time,
                // 'country_id'     => $d[0],
                // 'show_status'    => $d[1],
                'visible_status' => $request->visible_status ? '1' : '0',
                'parent_id' => $request->category ? $request->category : 0 // or Null
            ]);
        }

        if ($request->hasFile('icon')) {
            $time = time();
            $ext = $request->file('icon')->getClientOriginalExtension();
            Image::make($request->file('icon')->getRealPath())->save(public_path('PicCate/icon/' . $time . '.' . $ext));
            // $newImageName = time(). '.' . $request->photo->extension();
            $mydataCreated->icon = $time . '.' . $ext;
            $mydataCreated->update();
        }
        // if($mydataCreated->save()){
        //     return redirect()->route('categories.index')->with(['success' => 'Category added succes']);
        // }
        return redirect()->route('categories.main')
            ->with('success', 'Successfuly added data');
    }
    public function edit($id)
    {

        $category = Category::with('parent')->findOrFail($id);
        $categories = Category::with(['supcategories', 'parent'])->where('parent_id', '=', 0)->get();
        $getSub = Category::with('parent')->where('id', $id)->first();
        // dd($getCate , $category);
        // dd($category->with(['supcategories' , 'parent'])->get());
        // dd($category);

        $countries = Countries::select('id', 'country_name', 'show_status')->get();
        //   dd($category);
        return view('dash-board.categories.editCategories', compact(['id', 'getSub', 'category', 'categories', 'countries']));
    }
    public function update(Request $request, Category $category, $id)
    {
        $category = Category::find($id);
        $request->validate([
            'category_name' => 'required',
            'href' => 'required',//|unique:categories,href
            'title' => 'required',
            // 'visible_status' => 'required'
        ]);
        $image = $request->image;
        if ($request->hasFile('image')) {
            $pathImg = str_replace('\\', '/', public_path('PicCate/')) . $category->image;
            if (File::exists($pathImg)) {
                File::delete($pathImg);
            }
            $time = time();
            Image::make($request->file('image')->getRealPath())->encode('webp', 100)->resize(100, 60)->save(public_path('PicCate/' . $time . '.webp'));
            DB::table('categories')->where('id', $category->id)->update([
                'image' => $time . '.' . 'webp',
            ]);
        }
        if ($request->hasFile('icon')) {
            $pathIcon = str_replace('\\', '/', public_path('PicCate/icon/')) . $category->icon;
            if (File::exists($pathIcon)) {
                File::delete($pathIcon);
            }
            $time = time();
            $ext = $request->file('icon')->getClientOriginalExtension();
            Image::make($request->file('icon')->getRealPath())->save(public_path('PicCate/icon/' . $time . '.' . $ext));
            // $newImageName = time(). '.' . $request->photo->extension();
            $category->icon = $time . '.' . $ext;

        }
        if ($category->parent_id) {
            DB::table('categories')->where('id', $id)->update([
                'parent_id' => $request->category,
            ]);
        }
        $category->category_name = $request->category_name;
        $category->href = $request->href;
        $category->keywords = $request->keywords;
        $category->title = $request->title;
        // $category->country_id  = $d[0];
        // $category->show_status = $d[1];

        $category->visible_status = $request->visible_status;
        $category->update();

        return redirect()->route('categories.main')
            ->with('success', 'Successfuly updated data');
    }
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);
        if (is_numeric($request->id)) {
            Category::where('parent_id', $request->id)->delete();
            Category::where('id', $request->id)->delete();
            Sites::where('category_id', $request->id)->delete();

        }
        if ($category->image) {
            $pathImg = str_replace('\\', '/', public_path('PicCate/')) . $category->image;
            if (File::exists($pathImg)) {
                File::delete($pathImg);
            }
        }
        if ($category->icon) {
            $pathIcon = str_replace('\\', '/', public_path('PicCate/icon/')) . $category->icon;
            if (File::exists($pathIcon)) {
                File::delete($pathIcon);
            }
        }

        // $categories = Category::find($id);
        // $categories->delete();
        return redirect()->route('categories.main')
            ->with('success', 'Successfuly deleted data');
    }


}


