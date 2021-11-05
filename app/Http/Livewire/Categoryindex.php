<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class Categoryindex extends Component
{
    public function render()
    {
        return view('writer.categoryindexs',[
            'category' => Category::all()
        ]);
    }

    public function delete(Category $id)
    {
        $id->delete();
    }
}
