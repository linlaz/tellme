<?php

namespace App\Http\Livewire\storypublic;

use App\Models\Save;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcomestory extends Component
{
    public $limitPerPage = 3;

    protected $listeners = [
        'load-more' => 'loadMore'
    ];

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }

    public function render()
    {
        $users = Story::latest()->paginate($this->limitPerPage);
        $this->emit('load-more');

        return view('indexpage.welcomestory', ['story' => $users]);
    }

    // public function render()
    // {
    //     return view('indexpage.welcomestory', [
    //         'story' => $this->readyToLoad
    //             ? Story::where('publish',"1")->paginate(5)
    //             : [],
    //     ]);
    // }

    public function addsave($id, $item)
    {
        if (Auth::guest()) {
            return session()->flash('mustlogin', $item . ' unsuccessfully save. you must login');
        } else {
            $find = Save::where('user_id', Auth::user()->id)->where('destination', 'story')->where('destination_id', $id)->first();
            if (is_null($find)) {
                $find =  Save::create([
                    'user_id' => Auth::user()->id,
                    'destination' => 'story',
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
        $find = save::where('user_id', Auth::user()->id)->where('destination', 'story')->where('destination_id', $id)->first();
        if (!is_null($find)) {
            $find->delete();
            session()->flash('delete', $item . ' successfully unsave');
        } else {
            session()->flash('delete', 'sorry');
        }
    }
}
