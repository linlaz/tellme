<?php

namespace App\Http\Livewire\storypublic;

use App\Models\Save;
use App\Models\Story;
use App\Models\views;
use App\Models\IPuser;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Showstory extends Component
{
    public $findip, $slug, $comment, $findstory;
    public $formcomment = 'off';

    protected $listeners = ['success' => '$refresh'];

    public function mount(Request $request)
    {
        $this->findip = $request->ip();
        $this->findstory = Story::with('comment')->where('slug', $this->slug)->first();
    }

    public function render()
    {
        // $findstory = Story::with('comment')->where('slug', $this->slug)->first();
        $finds = views::where('visitor', $this->findip)->where('destination', 'story')->where('destination_id', $this->findstory->id)->first();
        if (is_null($finds)) {
            $finds = Views::create([
                'visitor' => $this->findip,
                'destination' => 'story',
                'destination_id' => $this->findstory->id
            ]);
        }
        return view('indexpage.showstory', [
            'story' => $this->findstory
        ]);
    }

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
    public function comment($cek)
    {
        $this->formcomment = $cek;
    }

    public function savecomment()
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'subject' => $this->comment,
            'story_id' => $this->findstory->id
        ]);
        $this->formcomment = 'off';
        $this->emit('success');
    }
}
