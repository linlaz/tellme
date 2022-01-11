<?php

namespace App\Http\Livewire\user;

use App\Models\Blog;
use App\Models\Save;
use App\Models\User;
use App\Models\Story;
use App\Models\Message;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class IndexUserDashboardLivewire extends Component
{
    //edit
    public $idedit, $getusername = '', $getroleuseredit, $permission, $userpermission;
    //endedit
    public $form, $anyrole = [];
    public $deleteId = '';

    protected $listeners = [
        'success' => '$refresh'
    ];

    public function render()
    {
        return view('dashboard.user.index-user-dashboard-livewire', [
            'user' => User::with('roles', 'ipuser')->get()
        ]);
    }
    public function edit($id)
    {
        $finded = User::where('id', $id)->first();
        $this->form = 'edituser';
        $this->idedit = $finded->id;
        $this->getusername = $finded;
        $this->getroleuseredit = $finded->getRoleNames();
        $this->anyrole = Role::all();
        $this->permission = Permission::all();
        $this->userpermission = $finded->getAllPermissions()->pluck('name');
    }
    public function update(User $id)
    {
        $id->syncRoles($this->getroleuseredit);
        $id->syncPermissions($this->userpermission);
        $this->resetAll();
        $this->emit('success');
    }
    
    public function resetAll()
    {
        $this->anyrole = '';
        $this->form = '';
        $this->idedit = '';
        $this->getusername = '';
        $this->getroleuseredit = '';
        $this->permission = '';
        $this->userpermission = '';
    }

    public function delete(User $id)
    {
        Story::where('user_id', $id->id)->update([
            'user_id' => null
        ]);
        Save::where('user_id', $id->id)->delete();
        Message::where('user_id', $id->id)->orWhere('receiver_id',$id->id)->delete();
        Blog::where('user_id', $id->id)->update([
            'user_id' => null
        ]);
        $id->delete();
        $this->emit('success');
    }
    public function blok(User $id, $active)
    {
        $id->update([
            'active' => $active
        ]);
        $this->emit('success');
    }
}
