<?php

namespace App\Http\Livewire\storypublic;

use App\Models\Save;
use App\Models\Story;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcomestory extends Component
{
    public function render()
    {
        $stories = Story::with('saves')->where('publish', '1')->inRandomOrder()->paginate(10);
        return view('indexpage.welcomestory', [
            'story' => $stories,
        ]);
    }

    public function addsave($id, $item)
    {
        if (Auth::guest()) {
            session()->flash('mustlogin', $item . ' unsuccessfully save. you must login');
            return redirect()->to('/#');
        } else {
            $find = Save::where('user_id', Auth::user()->id)->where('destination', 'story')->where('destination_id', $id)->first();
            if (is_null($find)) {
                $find =  Save::create([
                    'user_id' => Auth::user()->id,
                    'destination' => 'story',
                    'destination_id' => $id
                ]);
            }
        }

        if ($find) {
            session()->flash('success', $item . ' successfully save');
        }
    }
    public function unsave($id, $item)
    {
        $find = save::where('user_id', Auth::user()->id)->where('destination', 'story')->where('destination_id', $id)->first();
        if (!is_null($find)) {
            $find->delete();
            session()->flash('delete', $item . ' successfully unsave');
        } else {
            session()->flash('delete', 'sorry');
        }
    }
}
