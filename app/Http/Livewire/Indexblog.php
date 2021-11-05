<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class Indexblog extends Component
{
    public function render()
    {
        return view('writer.indexblog', [
            'blog' => Blog::with('category')->orderby('created_at','asc')->get()
        ]);
    }

    public function actionp($action,$val,Blog $id)
    {
        if ($action == 'publish') {
            $id->update([
                'publish' => $val
            ]);
        }else{
            $id->delete();
        }
    }
}
