<?php

namespace App\Http\Livewire\writer;

use App\Models\Blog;
use Livewire\Component;
use App\Models\Category;
use App\Models\Save;
use App\Models\Views;

class Categoryindex extends Component
{
    public function render()
    {
        return view('writer.categoryindexs', [
            'category' => Category::all()
        ]);
    }

    public function delete(Category $id)
    {
        $findblog = blog::where('category_id', $id->id)->get('id');
        $view = Views::where('destination', 'blog')->whereIn('destination_id', collect($findblog->toArray()))->delete();
        $save = Save::where('destination', 'blog')->whereIn('destination_id', collect($findblog->toArray()))->delete();
        $findblog->toQuery()->delete();
        $id->delete();
    }
}
