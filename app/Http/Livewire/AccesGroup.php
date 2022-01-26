<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Helpers\Helper;
use App\Models\Group;
use App\Models\User;

class AccesGroup extends Component
{
    public $userName;
    public $roomCode;
    public $ip;
    public $user;
    public $step = 1;
    public $messageErr;

    public function mount(){
        $this->ip = $this->ip();
        $this->user = User::where('ip', $this->ip)->first();
        if($this->user)
            $this->step = 2;
        else
            $this->step = 1;
    }
    public function render()
    {
        return view('livewire.acces-group');
    }

    public function saveUser(){
        if(!$this->user){
            $this->validate([
                'userName' => 'required'
            ]);
            $this->user = User::create([
                'ip'    => $this->ip,
                'name' => $this->userName
            ]);
            $this->step = 2;
        }
    }

    public function start(){
        $this->validate([
            'roomCode' => 'required'
        ]);
        $group = Group::where('slug', $this->roomCode)->latest()->first();
        if($group){
            return redirect()->route('group',['group' =>$this->roomCode, 'user' => $this->user->id]);
        }else{
            $this->messageErr = "No group here :(";
        }

    }

    public function ip()
    {
        $helper = new Helper();
        return $helper->getIp(); // the above method
    }
}
