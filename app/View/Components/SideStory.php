<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class SideStory extends Component
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
        select v.destination_id, v.destination , b.stories,b.slug,b.created_at
        from views as v
        join stories as b
        on v.destination_id = b.id
        where destination = 'blog' 
        group by v.destination_id,v.destination,b.stories,b.slug,b.created_at
        order by count(v.destination_id) desc
        limit 3
        ");
        return view('components.side-story', ['trending' => $trending]);
    }
}
