<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $showtag = Tag::latest()->get();
        // return "Tags";
        return view('dash-board.Tags.allDataTag' , compact('showtag'));
    }


    public function create()
    {
        return view('dash-board.Tags.createTag');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required'
        ]);

        $mydataSites = Tag::create([
            'name'     =>$request->input('name'),
        ]);
        return redirect()->route('tags.main')
            ->with('success' , 'Successfuly added data');
    }


    // public function show(Tag $tag)
    // {
    //     //
    // }


    public function edit($id)
    {
        $obj = new Tag();

        $tag = $obj->find($id);
        return view('dash-board.Tags.editTag' , compact('tag'));
    }


    public function update(Request $request,$id)
    {
        $tag = Tag::find($id);
        $request->validate([
            'name'     => 'required'
        ]);

        $tag->name = $request->name;
        $tag->update();

        return redirect()->route('tags.main')
            ->with('success' , 'Successfuly updated data');
    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete($id);
        return redirect()->route('tags.main')
            ->with('success' , 'Successfuly deleted data');
    }
}
