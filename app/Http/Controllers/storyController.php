<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Story;
use App\Models\IPuser;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class storyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('story.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('story.create');
    }

    public function createguest()
    {

        return view('indexpage.addstorycontroller')->with('warning','coba');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $faker = Faker::create();
        $slug = Str::slug($faker->unique()->word() . '-' . $faker->unique()->randomNumber(8, false) . '-' . $faker->unique()->sentence());
        $find = Story::Where('slug', $slug)->first();
        if ($find != null) {
            while ($find->slug = $slug) {
                $slug = Str::slug($faker->unique()->word() . '-' . $faker->unique()->randomNumber(8, false) . '-' . $faker->unique()->sentence());
            }
        }
        $ipuser = IPuser::where('ip_user', $request->ip())->first();

        if (!is_null(Auth::user())) {
            $iduser = Auth::user()->id;
        } else {
            $iduser = NULL;
        }
        Story::create([
            'slug' => $slug,
            'choice' => $request->choice,
            'user_id' => $iduser,
            'publish' => '1',
            'stories' => $request->story,
            'ip_user' => $ipuser->id
        ]);
        if (is_null($iduser)) {
            return redirect("/story/" . $slug);
        } else {
            return redirect('/dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $blog = Blog::with('category')->where('publish', '1')->inRandomOrder()->limit(3)->get();
        return view('welcome', [
            'blog' => $blog
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $find = Story::where('slug', $slug)->first();
        return view('story.edit', [
            'story' => $find
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $find = Story::findorfail($request->id);
        $find->update([
            'stories' => $request->story
        ]);

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */

    public function show($slug)
    {
        return view('indexpage.storycontroller',[
            'story' => $slug
        ]);
    }
    public function showhistory($slug)
    {
        @dd($slug);
    }
}
