<?php

namespace App\Http\Livewire\story;

use App\Http\Livewire\action\AllAction;
use App\Models\Story;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;

class Indexstory extends Component
{
    public $totalRecords;
    public $loadAmount = 5;
    protected $listeners = [
        'success' => '$refresh'
    ];
    public function loadMore()
    {
        $this->loadAmount += 5;
    }

    public function mount()
    {
        $this->totalRecords = Story::with('saves')->where('publish', '1')->count();
    }
    public function addsave($destinationid, $destination)
    {
        $destinationid = Crypt::decrypt($destinationid);
        AllAction::addsave($destinationid, $destination);
    }
    public function unsave($destinationid, $destination)
    {
        $destinationid = Crypt::decrypt($destinationid);
        AllAction::unsave($destinationid, $destination);
    }
    public function render()
    {
        return view('story.indexstorylivewire')
            ->with(
                'story',
                Story::with('saves', 'comment')->where('publish', '1')
                    ->limit($this->loadAmount)
                    ->orderBy('created_at', 'asc')
                    ->get()
            );
    }
}
