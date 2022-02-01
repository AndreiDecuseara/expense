<?php

namespace App\Http\Livewire;

use App\Helpers\Helper;
use App\Models\User;
use Livewire\Component;
use App\Models\Group;

class AccesPersonal extends Component
{
    public $userName;
    public $ip;
    public $user;
    public $group;

    public function mount(){
        $this->ip = $this->ip();
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
        }
        $this->personalAcces();
    }

    public function ip()
    {
        $helper = new Helper();
        return $helper->getIp(); // the above method
    }

    public function personalAcces(){
        $slug = 'personal'.$this->user->id;
        if(!$this->group){
            $this->group = Group::create([
                'name'  => 'personal',
                'owner_id' => $this->user->id,
                'slug'  =>  $slug,
                'is_personal' => 1
            ]);
        }else{
            $this->group = Group::where('slug', $slug)->where('owner_id', $this->user->id)->latest()->first();
        }

        return redirect()->route('personal',['user' => $this->user->id, 'group' => $this->group->slug]);
    }

    public function render()
    {
        return view('livewire.acces-personal');
    }
}
