<?php

namespace App\Http\Livewire\profile;

use App\Models\Story;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\action\AllAction;
use App\Models\Comment;
use App\Models\Save;
use App\Models\views;
use Illuminate\Support\Facades\Crypt;

class IndexProfileLivewire extends Component
{
    public $totalRecords;
    public $action,$subject;
    public $loadAmount = 5;
    protected $listeners = [
        'success' => '$refresh',
        'successupdate' => 'resetall'
    ];
    public function resetall()
    {
        $this->action = null;
        $this->subject = null;
    }
    public function loadMore()
    {
        $this->loadAmount += 5;
    }

    public function mount()
    {
        $this->totalRecords = Story::where('user_id', Auth::id())->count();
    }
    public function render()
    {
            $story = Story::with('saves', 'views')->where('user_id', Auth::id())
            ->limit($this->loadAmount)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('profile.index-profile-livewire')
            ->with('story',$story);
    }
    public function actionp($val,$idstory)
    {
        $idstory = Crypt::decrypt($idstory);
        AllAction::publish($val,'story',$idstory);
    }
    public function actiondelete($idstory)
    {
        $idstory = Crypt::decrypt($idstory);
        Comment::where('story_id',$idstory)->delete();
        views::where('destination','story')->where('destination_id',$idstory)->delete();
        Save::where('destination_id',$idstory)->where('destination','story')->delete();
        story::destroy($idstory);
        $this->dispatchBrowserEvent('successdelete');
    }
    public function editstory($idstory)
    {
        $idstory = Crypt::decrypt($idstory);
        $this->action = 'edit';
        $this->subject = Story::findorfail($idstory);
        $this->emit('success');
        redirect('#story');
    }
}
