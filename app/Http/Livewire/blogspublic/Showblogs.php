<?php

namespace App\Http\Livewire\blogspublic;

use App\Models\Blog;
use App\Models\Save;
use App\Models\Views;
use App\Models\IPuser;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Showblogs extends Component
{
    public $findip;

    public function __construct(Request $request)
    {
        $find = IPuser::where('ip_user', $request->ip())->first();
        if (is_null($find)) {
            $find = IPuser::create([
                'ip_user' => $request->ip(),
                'active' => '1'
            ]);
        }

        $this->findip = $find->id;
    }

    public function render($slug)
    {
        $findblog = Blog::where('slug', $slug)->first();
        $finds = views::where('visitor', $this->findip)->where('destination', 'blog')->where('destination_id', $findblog->id)->first();
        if (is_null($finds)) {
            $finds = Views::create([
                'visitor' => $this->findip,
                'destination' => 'blog',
                'destination_id' => $findblog->id
            ]);
        }
        return view('indexpage.showblogs', [
            'blog' => $findblog,

        ]);
    }

    
    // public function addsave($id, $item)
    // {
    //     @dd($id);
    //     if (Auth::guest()) {
    //         session()->flash('mustlogin', $item . ' unsuccessfully save. you must login');
    //         return redirect()->to('/#');
    //     } else {
    //         $find = Save::where('user_id', Auth::user()->id)->where('destination', 'blog')->where('destination_id', $id)->first();
    //         if (is_null($find)) {
    //             $find =  Save::create([
    //                 'user_id' => Auth::user()->id,
    //                 'destination' => 'blog',
    //                 'destination_id' => $id
    //             ]);
    //         }
    //     }

    //     if ($find) {
    //         session()->flash('success', $item . ' successfully save');
    //     }
    // }
}
