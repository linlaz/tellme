<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
class roleController extends Controller
{

    public function index()
    {
        
        return view('role.index');
    }

}
