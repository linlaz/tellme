<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

use function Livewire\str;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('writer.blog');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('writer.create',[
            'category' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $findcatergory = Category::where('slug',$request->name)->first();
        if(is_null($findcatergory)){
            $request->validate([
                'name' => 'required|unique:categories'
            ]);
            $created = Category::create([
                'name' => $request->name,
                'slug' => Str::of($request->name)->slug('-')
            ]);
            $findcatergory = Category::where('slug',$created->slug)->first();
        }

        $request->validate([
            'title' => 'required|max:100',
            'text' => 'required'
        ]);
        $slug = Str::of($request->title)->slug('-') . rand();
        Blog::create([
            'title'=>$request->title,
            'slug'=> $slug,
            'text' => $request->text,
            'category_id' => $findcatergory->id,
            'user_id' => Auth::user()->id,
            'views' => 0,
            'publish' => 1
        ]);

        return redirect('/blog');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    public function showhistory($slug)
    {
        $find = Blog::where('slug', $slug)->first();
        $history = Activity::where('log_name', 'blog')->where('subject_id', $find->id)->orderBy('created_at', 'desc')->get();
        return view('writer.history',[
            'nowblog' => $find,
            'history' => $history
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $find = Blog::where('slug',$slug)->first();
        if(!is_null($find)){
            return view('writer.edit',[
                'blog' => $find,
                'category' => Category::all()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $findcatergory = Category::where('slug', $request->name)->first();
        if (is_null($findcatergory)) {
            $request->validate([
                'name' => 'required|unique:categories'
            ]);
            $created = Category::create([
                'name' => $request->name,
                'slug' => Str::of($request->name)->slug('-')
            ]);
            $findcatergory = Category::where('slug', $created->slug)->first();
        }
        $request->validate([
            'title' => 'required|max:100',
            'text' => 'required'
        ]);
        $slug = Str::of($request->title)->slug('-') . rand();
        $findblog = Blog::findorfail($request->id);
        $findblog->update([
            'title' => $request->title,
            'slug' => $slug,
            'text' => $request->text,
            'category_id' => $findcatergory->id,
        ]);

        return redirect('/blog');
    }


    public function categoryindex()
    {
        return view('writer.categoryindex');
    }
}
