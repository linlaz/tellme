<?php

namespace App\Http\Livewire\writer;

use App\Models\Blog;
use App\Models\Save;
use App\Models\views;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Indexblog extends Component
{
    public function render()
    {
        return view('writer.indexblog', [
            'blog' => Blog::with('category', 'views','saves')->orderby('created_at', 'asc')->paginate(5)
        ]);
    }

    public function actionp($action, $val, Blog $id)
    {
       
        if ($action == 'publish') {
            $id->update([
                'publish' => $val
            ]);
        } else {
            views::where('destination_id', $id->id)->where('destination', 'blog')->delete(); 
            Save::where('destination', 'blog')->where('destination_id', $id->id)->delete();
            $id->delete();
        }
    }
}
