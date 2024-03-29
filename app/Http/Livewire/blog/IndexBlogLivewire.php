<?php

namespace App\Http\Livewire\blog;


use Livewire\Component;
use App\Http\Livewire\action\AllAction;
use App\Models\Blog;
use Illuminate\Support\Facades\Crypt;
class IndexBlogLivewire extends Component
{
    public $totalRecords;
    public $loadAmount = 5;
    protected $listeners = [
        'success' => '$refresh'
    ];
    public function loadMore()
    {
        $this->loadAmount += 5;
    }
    public function mount()
    {
        $this->totalRecords = Blog::with('saves', 'category')->where('publish', '1')->count();
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
        return view('blog.index-blog-livewire')
            ->with(
                'blog',
                Blog::with('saves', 'category')->where('publish', '1')
                    ->limit($this->loadAmount)
                    ->inRandomOrder()
                    ->get()
            );
    }
}
