<?php

namespace App\Http\Livewire\action;

use App\Models\Blog;
use App\Models\Save;
use App\Models\Story;
use App\Models\Views;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllAction extends Component
{
    public $ipuser;
    protected $listeners = [
        'success' => '$refresh'
    ];

    public function mount(Request $request)
    {
        $this->ipuser = $request->attributes->get('ipuser');
    }

    public static function addsave($destinationid, $destination)
    {
        if (Auth::guest()) {
            session()->flash('failed', $destination . ' unsuccessfully save. you must login');
            return FALSE;
        } else {
            $find = Save::where('user_id', Auth::user()->id)->where('destination', $destination)->where('destination_id', $destinationid)->first();
            if (is_null($find)) {
                $find =  Save::create([
                    'user_id' => Auth::user()->id,
                    'destination' => $destination,
                    'destination_id' => $destinationid
                ]);
            }
        }
        if ($find) {
            session()->flash('success', $destination . ' successfully save');
            return TRUE;
        }
    }
    public static function unsave($destinationid, $destination)
    {
        $find = Save::where('user_id', Auth::user()->id)->where('destination', $destination)->where('destination_id', $destinationid)->first();
        if (!is_null($find)) {
            $find->delete();
            session()->flash('success', $destination . ' successfully unsave');
            return TRUE;
        } else {
            session()->flash('failed', 'sorry ' . $destination . ' successfully unsave');
            return FALSE;
        }
    }
    public static function addview($idip, $destination, $destionationid)
    {
        $finds = views::where('ipuser', $idip)->where('destination', $destination)->where('destination_id', $destionationid)->first();
        if (is_null($finds)) {
            $finds = Views::create([
                'ipuser' => $idip,
                'destination' => $destination,
                'destination_id' => $destionationid
            ]);
        }
    }
    public static function publish($val,$destination,$destinationid)
    {
        if($destination == 'story'){
            $story = Story::where('id',$destinationid)->first();
            if ($story) {
                $story->update(['publish'=>$val]);
            }
        }else{
            $blog = Blog::where('id',$destinationid)->first();
            if ($blog) {
                $blog->update(['publish'=>$val]);
            }
        }
    }
}
