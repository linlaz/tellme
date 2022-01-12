<?php

namespace App\Http\Livewire\suggestion;

use Livewire\Component;
use App\Models\Suggestions;

class IndexSuggestionLivewire extends Component
{
    public function render()
    {
        return view('dashboard.suggestion.index-suggestion-livewire',[
            'suggestions' => Suggestions::all(),
        ]);
    }
}
