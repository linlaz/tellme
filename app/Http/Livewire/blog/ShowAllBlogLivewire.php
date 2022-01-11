<?php

namespace App\Http\Livewire\blog;

use App\Models\Blog;
use App\Models\Save;
use App\Models\Views;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Http\Livewire\action\AllAction;

class ShowAllBlogLivewire extends Component
{
    public function render()
    {
        return view('dashboard.show-all-blog-livewire', [
            'blog' => Blog::with('category', 'views', 'saves')->orderby('created_at', 'asc')->paginate(5)
        ]);
    }
    public function actionp($val, $idstory)
    {
        $idstory = Crypt::decrypt($idstory);
        AllAction::publish($val, 'story', $idstory);
    }
    public function actiondelete($idblog)
    {
        $idblog = Crypt::decrypt($idblog);
        Views::where('destination', 'blog')->where('destination_id', $idblog)->delete();
        Save::where('destination_id', $idblog)->where('destination', 'blog')->delete();
        blog::destroy($idblog);
        $this->dispatchBrowserEvent('successdelete');
    }
}
