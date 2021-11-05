<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Story;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $limit = Str::limit(strip_tags($request->story), 20);
        $slug = Str::of($limit)->slug('-') . rand();
        Story::create([
            'slug' => $slug,
            'choice' => $request->choice,
            'user_id' => Auth::user()->id,
            'publish' => 1,
            'views' => 0,
            'stories' => $request->story,
        ]);

        return redirect('/dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $stories = Story::with(['user.name'])->where('publish',1)->paginate(10);
        return view('welcome',[
            'story' => $stories
        ]);
    }

    public function show($slug)
    {
        $find = Story::where('slug',$slug)->first();
        $comment = Comment::where('story_id',$find->id)->get();
        // ddd($find);
        return view('indexpage.story',[
            'story' => $find,
            'comment' => $comment
        ]);
    }


    public function showhistory($slug)
    {
        dd($slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $find = Story::where('slug',$slug)->first();
        return view('story.edit',[
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
        $limit = Str::limit(strip_tags($request->story), 20);
        $slug = Str::of($limit)->slug('-') . rand();
        $find->update([
            'stories' => $request->story,
            'slug' => $slug
        ]);
    
        return redirect('/dashboard');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(story $story)
    {
        //
    }
}
