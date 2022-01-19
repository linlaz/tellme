<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Faker\Factory as Faker;

class userController extends Controller
{
    
    public function index()
    {
        return view('profile.profileindexcontroller');
    }
    public function indexdashboard()
    {
        return view('dashboard.user.indexuserdashboardcontroller');
    }

    public function setting()
    {
        return view('profile.settingprofilecontroller');
    }
    public function create(Request $request)
    {
        $faker = Faker::create();
        return view('auth.register', [
            'name' => $faker->unique()->name(),
            'ip_user' => $request->ip()
        ]);
    }

    public function show($name)
    {
        $find = User::where('name', $name)->first();
        return view('user.detailuser', [
            'user' => $find,
            'activity' => Activity::where('causer_id', $find->id)->get()
        ]);
    }

}
