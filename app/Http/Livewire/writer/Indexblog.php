<?php

namespace App\Http\Livewire\writer;

use App\Models\Blog;
use App\Models\views;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Indexblog extends Component
{
    public function render()
    {
        return view('writer.indexblog', [
            'blog' => Blog::with('category')->orderby('created_at', 'asc')->paginate(5)
        ]);
    }

    public function actionp($action, $val, Blog $id)
    {
        views::where('destination_id',$id->id)->where('destination','blog')->delete();
        if ($action == 'publish') {
            $id->update([
                'publish' => $val
            ]);
        } else {
            $id->delete();
        }
    }
}
