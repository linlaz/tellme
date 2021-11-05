<?php

namespace App\Http\Controllers;

use App\Models\save;
use Illuminate\Http\Request;

class saveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('save.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\save  $save
     * @return \Illuminate\Http\Response
     */
    public function show(save $save)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\save  $save
     * @return \Illuminate\Http\Response
     */
    public function edit(save $save)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\save  $save
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, save $save)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\save  $save
     * @return \Illuminate\Http\Response
     */
    public function destroy(save $save)
    {
        //
    }
}
