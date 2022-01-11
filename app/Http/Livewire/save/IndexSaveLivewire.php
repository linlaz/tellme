<?php

namespace App\Http\Livewire\save;

use App\Models\Save as ModelsSave;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class IndexSaveLivewire extends Component
{
    public function render()
    {
        $save = ModelsSave::with('blog', 'story')->where('user_id', Auth::user()->id)->paginate(5);
        return view('save.index-save-livewire', [
            'save' => $save
        ]);
    }
    public function delete($idsave)
    {
        $idsave = Crypt::decrypt($idsave);
        $success = ModelsSave::findorfail($idsave);
        $success->delete();
        if($success){
            $this->dispatchBrowserEvent('successdelete');
        };

    }
}
