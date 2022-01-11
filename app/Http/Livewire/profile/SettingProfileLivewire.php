<?php

namespace App\Http\Livewire\profile;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SettingProfileLivewire extends Component
{

    public $name, $email, $password,$detail;
    public function mount(Request $request)
    {
        $this->detail = $request->ipinfo->all;
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
    }
    public function updateemail()
    {
        $this->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id
        ]);
        $user = Auth::user();
        $user->update([
            'email' => $this->email
        ]);
        session()->flash('successupdateemail', 'email successfully updated.');
    }
    public function updateusername()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:users,name,' . Auth::user()->id
        ]);
        $user = Auth::user();
        $user->update([
            'name' => $this->name
        ]);
        session()->flash('successupdatename', 'name successfully updated.');
    }
    public function updatepassword()
    {
        $this->validate([
            'password' => 'required|string|max:255|min:8'
        ]);
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($this->password)
        ]);
        session()->flash('successupdatepassword', 'password successfully updated.');
    }
    public function render()
    {
        return view('profile.setting-profile-livewire');
    }
}
