<?php

namespace App\Http\Livewire;

use App\Models\Story;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Indexstory extends Component
{
    protected $listeners = [
        'success' => '$refresh',
    ];

    public function render()
    {
        return view('story.indexstory', [
            'stories' => Story::where('user_id', Auth::user()->id)->paginate(3)
        ]);
    }

    public function actionp($action,Story $slug)
    {
        if ($action != 'd') {
                $slug->update([
                    'publish' => $action
                ]);
        }else{
            $slug->delete();
        }
        $this->emit('success');
    }


}
