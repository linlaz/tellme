<?php

namespace App\Http\Livewire\blogspublic;

use App\Models\Blog;
use App\Models\Save;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Showallblogs extends Component
{
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $blog = Blog::where('publish', 1)->inRandomOrder()->paginate(5);
        return view('indexpage.showallblogs', [
            'blog' => $blog
        ]);
    }

    public function addsave($id, $item)
    {
        if (Auth::guest()) {
            session()->flash('mustlogin', $item . ' unsuccessfully save. you must login');
            return redirect()->to('/#');
        } else {
            $find = Save::where('user_id', Auth::user()->id)->where('destination', 'blog')->where('destination_id', $id)->first();
            if (is_null($find)) {
                $find =  Save::create([
                    'user_id' => Auth::user()->id,
                    'destination' => 'blog',
                    'destination_id' => $id
                ]);
            }
        }

        if ($find) {
            session()->flash('success', $item . ' successfully save');
        }
    }
    public function unsave($id,$item)
    {
        $find = save::where('user_id',Auth::user()->id)->where('destination','blog')->where('destination_id',$id)->first();
        if(!is_null($find)){
            $find->delete();
            session()->flash('delete',$item.' successfully unsave');
        }else{
            session()->flash('delete','sorry');
        }
    }
}
