<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;

class konsultasiController extends Controller
{
   
    public function index()
    {
        return view('konsultasi.indexkonsultasicontroller');
    }

    public function indexkonsultasidashboard()
    {
        return view('dashboard.consul.indexconsulcontroller');
    }
   
}
