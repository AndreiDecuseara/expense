<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class NewGroup extends Component
{
    public $userName;
    public $roomName;
    public $ip;
    public $user;
    public $step = 1;

    public function mount(){
        $this->ip = $this->ip();
        $this->user = User::where('ip', $this->ip)->first();
        if($this->user)
            $this->step = 2;
        else
            $this->step = 1;
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
            'roomName' => 'required'
        ]);
        $slugRoom = $this->roomName . $this->user->id;
        $slugRoom = strtolower(str_replace(' ', '',$slugRoom));
        $group = Group::create([
            'name'  => $this->roomName,
            'owner_id' => $this->user->id,
            'slug'  => $slugRoom
        ]);
        return redirect()->route('group',['group' =>$slugRoom, 'user' => $this->user->id]);
    }

    public function ip()
    {
        $helper = new Helper();
        return $helper->getIp(); // the above method
    }
    public function render()
    {
        return view('livewire.new-group');
    }


    // help methods
}
