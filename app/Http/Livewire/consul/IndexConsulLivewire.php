<?php

namespace App\Http\Livewire\consul;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;

class IndexConsulLivewire extends Component
{
    public $message;
    public $allmessages;
    public $sender = null;
    public function render()
    {
        $users = User::with('roles')->role('admin')->get();
        $sender = $this->sender;
        $this->allmessages;
        return view('konsultasi.index-consul-livewire', compact('users', 'sender'));
    }
    public function mountdata()
    {
        if (isset($this->sender->id)) {
            $this->allmessages = Message::with('user')->where('user_id', auth()->id())
                ->where('receiver_id', $this->sender->id)
                ->orWhere('user_id', $this->sender->id)
                ->where('receiver_id', auth()->id())->orderBy('id', 'asc')
                ->get();
            $not_seen = Message::where('user_id', $this->sender->id)->where('receiver_id', auth()->id());
            $not_seen->update(['is_seen' => true]);
        }
    }
    public function resetForm()
    {
        $this->message = '';
    }
    public function resetsender()
    {
        $this->sender = null;
        $this->allmessages = null;
    }

    public function SendMessage()
    {
        $data = new Message;
        $data->message = $this->message;
        $data->user_id = auth()->id();
        $data->receiver_id = $this->sender->id;
        $data->save();
        $this->resetForm();
    }
    public function getUser($userId)
    {
        $user = User::find($userId);
        $this->sender = $user;
        $this->allmessages = Message::with('user')
        ->where('user_id', auth()->id())
            ->where('receiver_id', $userId)
            ->orWhere('user_id', $userId)
            ->where('receiver_id', auth()->id())
            ->orderBy('id', 'asc')
            ->get();
    }
}