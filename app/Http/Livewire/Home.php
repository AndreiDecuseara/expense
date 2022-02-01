<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Helpers\Helper;
use App\Models\Group;

class Home extends Component
{
    public $user;
    public $ip;

    public function mount(){
        $this->ip = $this->ip();
        $this->user = User::where('ip', $this->ip)->first();
    }

    public function ip()
    {
        $helper = new Helper();
        return $helper->getIp(); // the above method
    }

    public function personalAcces(){
        $slug = 'personal'.$this->user->id;
        $group = Group::where('slug', $slug)->where('owner_id', $this->user->id)->latest()->first();
        return redirect()->route('personal',['user' => $this->user->id, 'group' => $group->slug]);
    }

    public function render()
    {
        return view('livewire.home');
    }
}
