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
    public $findip, $story, $comment;
    public $formcomment = 'off';

    protected $listeners = ['success' => '$refresh'];
    public function mount(Request $request)
    {
        $this->findip = IPuser::where('ip_user', $request->ip())->where('active', '1')->first();
        $finds = views::where('visitor', $this->findip->id)->where('destination', 'story')->where('destination_id', $this->story->id)->first();
        if (is_null($finds)) {
            $finds = Views::create([
                'visitor' => $this->findip->id,
                'destination' => 'story',
                'destination_id' => $this->story->id
            ]);
        }
    }

    public function render()
    {

        return view('indexpage.showstory', [
            'story' => $this->story
        ]);
    }

    public function addsave($id, $item)
    {
        if (Auth::guest()) {
            $this->emit('success');
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
            $this->emit('success');
            return session()->flash('success', $item . ' successfully save');
        }
    }
    public function unsave($id, $item)
    {
        $find = save::where('user_id', Auth::user()->id)->where('destination', 'story')->where('destination_id', $id)->first();
        if (!is_null($find)) {
            $find->delete();
            session()->flash('delete', $item . ' successfully unsave');
            $this->emit('success');
        } else {
            session()->flash('delete', 'sorry');
            $this->emit('success');
        }
    }
    public function comment($cek)
    {
        $this->formcomment = $cek;
    }

    public function savecomment()
    {
        // $this->validate();
        Comment::create([
            'user_id' => $this->findip->id,
            'subject' => $this->comment,
            'story_id' => $this->findstory->id
        ]);
        $this->formcomment = 'off';
        $this->comment = '';
    }
    public function cancelcomment()
    {
        $this->formcomment = 'off';
        $this->comment = '';
        $this->emit('success');
    }
}
