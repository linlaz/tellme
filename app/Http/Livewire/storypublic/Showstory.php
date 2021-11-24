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
    public $findip,$slug, $comment;
    public $formcomment = 'off';

    public function mount(Request $request,$slug)
    {
        $this->findip = $request->ip();
        $this->slug = $slug;
    }

    public function render()
    {
        $findstory = Story::where('slug', $this->slug)->first();
        $finds = views::where('visitor', $this->findip)->where('destination', 'story')->where('destination_id', $findstory->id)->first();
        if (is_null($finds)) {
            $finds = Views::create([
                'visitor' => $this->findip,
                'destination' => 'story',
                'destination_id' => $findstory->id
            ]);
        }
        return view('indexpage.showstory', [
            'story' => $findstory
        ]);
    }

    public function addsave($id, $item)
    {
        if (Auth::guest()) {
            session()->flash('mustlogin', $item . ' unsuccessfully save. you must login');
            return redirect()->to('/#');
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
        @dd($this->comment);
        Comment::create([
            'user_id' => Auth::user()->id,
            'subject' => $this->comment,
            'story_id' => 1
        ]);
    }
}
