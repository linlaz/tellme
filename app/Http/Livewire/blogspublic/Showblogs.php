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
    public $slug;
    public function render()
    {
        $find = Blog::where('publish', 1)->where('slug', $this->slug)->first();
        
        return view('indexpage.showblogs', [
            'blog' => $find,

        ]);
    }


    public function addsave($id, $item)
    {
        if (Auth::guest()) {
            return session()->flash('mustlogin', $item . ' unsuccessfully save. you must login');
        } else {
            $find = Save::where('user_id', Auth::user()->id)->where('destination', 'blog')->where('destination_id', $id)->first();
            if (is_null($find)) {
                $find =  Save::create([
                    'user_id' => Auth::user()->id,
                    'destination' => 'blog',
                    'destination_id' => $id
                ]);
            }
        }

        if ($find) {
            session()->flash('success', $item . ' successfully save');
        }
    }
    public function unsave($id, $item)
    {
        $find = save::where('user_id', Auth::user()->id)->where('destination', 'blog')->where('destination_id', $id)->first();
        if (!is_null($find)) {
            $find->delete();
            session()->flash('delete', $item . ' successfully unsave');
        } else {
            session()->flash('delete', 'sorry');
        }
    }
}
