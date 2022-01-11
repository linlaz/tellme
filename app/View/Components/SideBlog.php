<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class SideBlog extends Component
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
        $trending = DB::select("
        select v.destination_id, v.destination , b.title,b.slug,b.text
        from views as v
        join blogs as b
        on v.destination_id = b.id
        where destination = 'blog' 
        group by v.destination_id,v.destination,b.title,b.slug,b.text
        order by count(v.destination_id) desc
        limit 3
        ");
        return view('components.side-blog', [
            'trending' => $trending
        ]);
    }
}
