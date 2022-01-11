<?php

namespace App\Http\Livewire\story;


use App\Models\Story;
use App\Models\IPuser;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\action\AllAction;
use App\Models\Comment;
use Illuminate\Support\Facades\Crypt;

class Showstory extends Component
{
    public $story, $idip;
    //comment
    public $comment;
    protected $rules = [
        'comment' => 'required',
    ];
    protected $listeners = [
        'success' => '$refresh'
    ];
    public function mount(Request $request, $slug)
    {
        $story = Story::with('saves', 'comment')->where('slug', $slug)->where('publish', "1")->first();
        $this->idip = $request->attributes->get('ipuser');
        AllAction::addview($this->idip, 'story', $story->id);
        $this->story = $story;
    }
    public function render()
    {
        return view('story.showstorylivewire', [
            'story' => $this->story
        ]);
    }
    public function addsave($destinationid, $destination)
    {
        $destinationid = Crypt::decrypt($destinationid);
        $action = AllAction::addsave($destinationid, $destination);
        if ($action) {
            $this->emitSelf('success');
        }
    }

    public function unsave($destinationid, $destination)
    {
        $destinationid = Crypt::decrypt($destinationid);
        $action = AllAction::unsave($destinationid, $destination);
        if ($action) {
            $this->emitSelf('success');
        }
    }
    public function sendcomment($idstory)
    {
        $idstory = Crypt::decrypt($idstory);
        $this->validate();
        if (Auth::id()) {
            $user_id = Auth::id();
        } else {
            $user_id = null;
        }
        Comment::create([
            'user_id' => $user_id,
            'ipuser' => $this->idip,
            'subject' => $this->comment,
            'story_id' => $idstory
        ]);
        $this->comment = '';
        $this->emit('success');
    }
    public function deletecomment($idcomment)
    {
        $idcomment = Crypt::decrypt($idcomment);
        $comment = Comment::findOrFail($idcomment);
        $comment->delete();
        $this->emit('success');
        $this->dispatchBrowserEvent('successdelete');
    }
}
