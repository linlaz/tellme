<?php

namespace App\Http\Livewire\story;

use App\Models\Save;
use App\Models\Story;
use App\Models\views;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination; 
class Indexstory extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'success' => '$refresh',
    ];
    
    public function render()
    {

        if (Auth::user()->hasRole('admin')) {
          $story = Story::with('views')->paginate(3);
        }else{
            $story = Story::with('views')->where('user_id', Auth::user()->id)->paginate(3);
        }
        return view('story.indexstory', [
            'stories' => $story
        ]);
    }

    public function actionp($action, Story $slug)
    {
        $views = views::where('destination','story')->where('destination_id',$slug->id)->delete();
        $views = Save::where('destination', 'story')->where('destination_id', $slug->id)->delete();
        if ($action != 'd') {
            $slug->update([
                'publish' => $action
            ]);
        } else {
            $slug->delete();
        }
        $this->emit('success');
    }
}
