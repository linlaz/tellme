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
   
    public function index()
    {
        $category = Category::limit(10)->get();
        return view('blog.indexblogcontroller', [
            'category' => $category
        ]);
    }
    public function showbycategory($slugcategory)
    {
        $category = Category::where('slug', $slugcategory)->first();
        return view('blog.showbycategorycontroller', [
            'slug' => $category->id
        ]);
    }
    public function showdashboard()
    {
        return view('dashboard.showallblogcontroller');
    }
  
    public function create()
    {
        return view('dashboard.blog.createblogcontroller', [
            'category' => Category::all()
        ]);
    }

   
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
        $checkblog = Blog::where('slug', $slug)->first();
        while ($checkblog != null) {
            $checkblog = Blog::where('slug', $slug)->first();
        }
        Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'text' => $request->text,
            'category_id' => $findcatergory->id,
            'user_id' => Auth::user()->id,
            'views' => 0,
            'publish' => 1
        ]);

        return redirect('/dashboard/blog');
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

    public function show($slug)
    {
        $next = Blog::where('publish', '1')->where('slug', '!=', $slug)->limit(8)->get();
        return view('blog.showblogcontroller', [
            'slug' => $slug,
            'next' => $next
        ]);
    }

   
    public function editdashboard($slug)
    {
        $find = Blog::where('slug', $slug)->first();
        if (!is_null($find)) {
            return view('dashboard.blog.editblogcontroller', [
                'blog' => $find,
                'category' => Category::all()
            ]);
        }
    }

   
    public function updatedashboard(Request $request)
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

        $findblog = Blog::findorfail($request->id);
        $findblog->update([
            'title' => $request->title,
            'text' => $request->text,
            'category_id' => $findcatergory->id,
        ]);

        return redirect('/dashboard/blog');
    }


    public function categoryindex()
    {
        return view('writer.categoryindex');
    }
}
