<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Helpers\Helper;

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

    public function render()
    {
        return view('livewire.home');
    }
}
