<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Story;
use App\Models\Views;
use App\Models\IPuser;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class storyController extends Controller
{
  
    public function index()
    {
        $story = Story::with('saves')->where('publish','1')->get();
        return view('story.indexstorycontroller',[
            'story' => $story
        ]);
    }

   
    public function create()
    {
        return view('story.create');
    }

    public function createguest()
    {

        return view('indexpage.addstorycontroller')->with('warning', 'coba');
    }
   
     public function showdashboard()
     {
         return view('dashboard.showallstorycontroller');
     }

   
    public function edit($slug)
    {
        $find = Story::where('slug', $slug)->first();
        return view('story.edit', [
            'story' => $find
        ]);
    }

  
    public function update(Request $request)
    {

        $find = Story::findorfail($request->id);
        $find->update([
            'stories' => $request->story
        ]);

        return redirect('/dashboard');
    }

    
    public function show($slug)
    {
        return view('story.showstorycontroller', [
            'slug' => $slug
        ]);
    }
}
