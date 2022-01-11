<?php

namespace App\Http\Livewire\story;

use App\Models\Save;
use App\Models\Story;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Http\Livewire\action\AllAction;
use App\Models\views;

class ShowAllStoryLivewire extends Component
{
    public function render()
    {
        return view('dashboard.show-all-story-livewire', [
            'stories' => Story::with('saves', 'views')->paginate(5),
        ]);
    }
    public function actionp($val, $idstory)
    {
        $idstory = Crypt::decrypt($idstory);
        AllAction::publish($val, 'story', $idstory);
    }
    public function actiondelete($idstory)
    {
        $idstory = Crypt::decrypt($idstory);
        Comment::where('story_id', $idstory)->delete();
        Views::where('destination', 'story')->where('destination_id', $idstory)->delete();
        Save::where('destination_id', $idstory)->where('destination', 'story')->delete();
        story::destroy($idstory);
        $this->dispatchBrowserEvent('successdelete');
    }
}
