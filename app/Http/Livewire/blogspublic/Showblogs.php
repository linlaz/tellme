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
    public $blog;
    public function render()
    {
        return view('indexpage.showblogs', [
            'blog' => $this->blog,

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
