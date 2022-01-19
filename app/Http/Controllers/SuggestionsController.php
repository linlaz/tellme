<?php

namespace App\Http\Controllers;

use App\Models\Suggestions;
use App\Http\Requests\StoreSuggestionsRequest;
use App\Http\Requests\UpdateSuggestionsRequest;
use App\Models\IPuser;
use Illuminate\Http\Request;

class SuggestionsController extends Controller
{
  
    public function index()
    {
        return view('suggestions.index');
    }

    
    public function indexdashboard()
    {
        return view('dashboard.suggestion.indexsuggestioncontroller');
    }
 
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
   
    public function showall()
    {
        return view('suggestions.showall',[
            'suggestions' => Suggestions::all()
        ]);
    }

}
