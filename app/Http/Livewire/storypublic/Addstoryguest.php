<?php

namespace App\Http\Livewire\storypublic;

use Livewire\Component;

class Addstoryguest extends Component
{
    public $choice = 'text';

    public function render()
    {
        return view('indexpage.Addstoryguest');
    }
}
