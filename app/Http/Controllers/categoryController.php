<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class categoryController extends Controller
{
   public function showcategorydashboard()
   {
       return view('dashboard.category.showallcategorycontroller');
   }
}
