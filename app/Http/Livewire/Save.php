<?php

namespace App\Http\Livewire;

use App\Models\Save as ModelsSave;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Save extends Component
{
    public function render()
    {
        $save = ModelsSave::with('blog','story')->where('user_id', Auth::user()->id)->paginate(5);
        return view('save.save', [
            'save' => $save
        ]);
    }
    public function delete($destination, $destination_id)
    {
        ModelsSave::where('destination', $destination)->where('destination_id', $destination_id)->delete();
    }
}
