<?php

namespace App\Http\Controllers;

use App\Models\Suggestions;
use App\Http\Requests\StoreSuggestionsRequest;
use App\Http\Requests\UpdateSuggestionsRequest;

class SuggestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreSuggestionsRequest $request)
    {
        //
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
