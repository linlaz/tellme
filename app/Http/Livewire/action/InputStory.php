<?php

namespace App\Http\Livewire\action;

use App\Models\Story;
use App\Models\IPuser;
use Livewire\Component;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InputStory extends Component
{
    public $form = 'text';
    public $action;
    public $story;
    public $idstory, $stories;
    protected $listeners = [
        'success' => '$refresh'
    ];
    protected $rules = [
        'story' => 'required',
    ];
    public function mount()
    {
        if ($this->action == 'edit') {
            $this->form = 'text';
            $this->story = html_entity_decode(strip_tags($this->stories));
        }
    }
    public function actionform($action)
    {
        if ($action == 'text') {
            $this->story = null;
        }
        $this->form = $action;
    }
    public function sendstory(Request $request)
    {
        $this->validate();
        $faker = Faker::create();
        $slug = Str::slug($faker->unique()->word() . '-' . $faker->unique()->randomNumber(8, false) . '-' . $faker->unique()->sentence());
        $find = Story::Where('slug', $slug)->first();
        if ($find != null) {
            while ($find->slug = $slug) {
                $slug = Str::slug($faker->unique()->word() . '-' . $faker->unique()->randomNumber(8, false) . '-' . $faker->unique()->sentence());
            }
        }
        $ipuser = IPuser::where('ip_user', $request->ip())->first();

        if (!is_null(Auth::user())) {
            $iduser = Auth::user()->id;
        } else {
            $iduser = NULL;
        }
        $story =  Story::create([
            'slug' => $slug,
            'choice' => $this->form,
            'user_id' => $iduser,
            'publish' => '1',
            'stories' => $this->story,
            'ip_user' => $ipuser->id
        ]);
        if ($story) {
            $this->emit('success');
            return redirect("/story/" . $slug);
        }
    }
    public function render()
    {
        return view('livewire.input-story');
    }
    public function editstory()
    {
        $this->validate();
        $story = Story::findorfail($this->idstory);
        $story->update([
            'stories' => $this->story
        ]);
        $this->emit('successupdate');
        redirect('/profile');
    }
}
