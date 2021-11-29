<?php

namespace App\View\Components;

use App\Models\Blog;
use Illuminate\View\Component;

class rightside extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $blog = Blog::with('category')->where('publish', '1')->inRandomOrder()->limit(3)->get();
        return view('components.rightside',[
            'blog' => $blog,
        ]);
    }
}
