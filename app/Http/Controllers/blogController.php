<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\views;
use App\Models\Category;
use App\Models\IPuser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;


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
        return view('writer.create', [
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
        Blog::create([
            'title' => $request->title,
            'slug' => $slug,
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
    public function showall()
    {

        $trending = DB::select("
        select v.destination_id, v.destination , b.title,b.slug,b.text
        from views as v
        join blogs as b
        on v.destination_id = b.id
        where destination = 'blog' 
        group by v.destination_id,v.destination,b.title,b.slug,b.text
        order by count(v.destination_id) desc
        limit 3
        ");
        $category = Category::limit(10)->get();
        return view('indexpage.blogcontroller', [
            'trending' => $trending,
            'category' => $category
        ]);
    }

    public function showhistory($slug)
    {
        $find = Blog::where('slug', $slug)->first();
        $history = Activity::with('user')->where('log_name', 'blog')->where('subject_id', $find->id)->orderBy('created_at', 'desc')->get();
        return view('writer.history', [
            'nowblog' => $find,
            'history' => $history
        ]);
    }

    public function show(Request $request, $slug)
    {
        $next = Blog::with('category')->where('publish', 1)->inRandomOrder()->limit(2)->get();
        $findblog = Blog::where('publish',1)->where('slug',$slug)->first();
        $finds = views::where('visitor', $request->ip())->where('destination', 'blog')->where('destination_id', $findblog->id)->first();
        if (is_null($finds)) {
            $finds = Views::create([
                'visitor' => $request->ip(),
                'destination' => 'blog',
                'destination_id' => $findblog->id
            ]);
        }
        return view('indexpage.showblogcontroller', [
            'blog' => $findblog,
            'next' => $next
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
        $find = Blog::where('slug', $slug)->first();
        if (!is_null($find)) {
            return view('writer.edit', [
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
