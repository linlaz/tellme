<?php

namespace App\Http\Livewire\writer;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Historyblog extends Component
{
    public $idhistory;
    protected $listeners = [
        'success' => '$refresh'
    ];
    public function mount($idhistory)
    {
        $this->idhistory = Activity::where('id', $idhistory)->first();
    }
    public function delete()
    {
        $this->idhistory->delete();
        $this->emit('success');
    }
    public function render()
    {
        return <<<'blade'
            <i onclick="confirm('Are you sure you want to delete this blog ?') || event.stopImmediatePropagation()"
                                wire:click="delete" type="button"
                                class="btn btn-danger m-2 ri-delete-bin-5-fill" title="delete your blog">
            </i>
        blade;
    }
}
