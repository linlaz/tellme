<?php

namespace App\Http\Livewire\blog;


use App\Models\Blog;
use App\Models\IPuser;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Livewire\action\AllAction;

class ShowBlogLivewire extends Component
{
    public $blog;
    protected $listeners = [
        'success' => '$refresh'
    ];
    public function mount(Request $request, $slug)
    {
        $blog = Blog::with('saves', 'category')->where('slug', $slug)->where('publish', "1")->first();
        $this->idip = $request->attributes->get('ipuser');
        AllAction::addview($this->idip, 'blog', $blog->id);
        $this->blog = $blog;
    }
    public function addsave($destinationid, $destination)
    {
        $destinationid = Crypt::decrypt($destinationid);
        $action = AllAction::addsave($destinationid, $destination);
        if ($action) {
            $this->emitSelf('success');
        }
    }

    public function unsave($destinationid, $destination)
    {
        $destinationid = Crypt::decrypt($destinationid);
        $action = AllAction::unsave($destinationid, $destination);
        if ($action) {
            $this->emitSelf('success');
        }
    }
    public function render()
    {
        return view('blog.show-blog-livewire');
    }
}
