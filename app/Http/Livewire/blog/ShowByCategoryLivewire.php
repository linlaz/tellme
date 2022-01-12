<?php

namespace App\Http\Livewire\blog;

use App\Models\Blog;
use Livewire\Component;
use App\Http\Livewire\action\AllAction;
use Illuminate\Support\Facades\Crypt;

class ShowByCategoryLivewire extends Component
{
    public $slug;
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
        $this->totalRecords = Blog::with('saves', 'category')->where('publish', '1')->where('category_id', $this->slug)->count();
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
        return view('blog.show-by-category-livewire')
            ->with(
                'blog',
                Blog::with('saves', 'category')->where('publish', '1')->where('category_id', $this->slug)
                    ->limit($this->loadAmount)
                    ->get()
            );
    }
}
