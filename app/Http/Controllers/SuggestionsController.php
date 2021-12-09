<?php

namespace App\Http\Controllers;

use App\Models\Suggestions;
use App\Http\Requests\StoreSuggestionsRequest;
use App\Http\Requests\UpdateSuggestionsRequest;
use App\Models\IPuser;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('suggestions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSuggestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'suggestion' => ['required']
        ]);
        $findip = IPuser::where('ip_user',$request->ip())->first();
        Suggestions::create([
            'email' => $request->email,
            'subject' => $request->suggestion,
            'ipuser' => $findip->id
        ]);

        return back()->with('success','thanks for your suggestion');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suggestions  $suggestions
     * @return \Illuminate\Http\Response
     */
    public function show(Suggestions $suggestions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suggestions  $suggestions
     * @return \Illuminate\Http\Response
     */
    public function edit(Suggestions $suggestions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSuggestionsRequest  $request
     * @param  \App\Models\Suggestions  $suggestions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSuggestionsRequest $request, Suggestions $suggestions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suggestions  $suggestions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suggestions $suggestions)
    {
        //
    }
}
