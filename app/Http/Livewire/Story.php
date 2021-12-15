<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Story extends Component
{
    public $choice = 'text';
    
    public function render()
    {
        return view('story.form');
    }
}
