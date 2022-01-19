<?php

namespace App\Http\Controllers;

use App\Models\save;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class saveController extends Controller
{
  
    public function index()
    {
        
        return view('save.indexsavecontroller');
    }

}
