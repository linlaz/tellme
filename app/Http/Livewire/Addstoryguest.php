<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Addstoryguest extends Component
{
    public $pilihan = 'text';

    public function render()
    {
        return view('indexpage.Addstoryguest');
    }
}
