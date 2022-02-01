<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\Group;
use App\Models\User;
use Livewire\Component;

class Personal extends Component
{
    public $card;
    public $pointCard;
    public $priceCard;
    public $cardInfo;
    public $user;
    public $step = 1;
    public $group;

    public function mount($group, $user){
        $this->user = User::where('id', $user)->first();
        $this->group = Group::where('slug', $group)->latest()->first();
        $this->card = Card::where('user_id', $this->user->id)->where('room_id', $this->group->id)->first();

        if($this->user)
            $this->step = 2;
        else
            $this->step = 1;
    }

    public function deleteInfo($key){
        $lastPoints = json_decode($this->card->point_card);
        $card = Card::find($this->card->id);
        array_splice($lastPoints, $key, 1);
        $card->point_card = json_encode($lastPoints);
        $card->save();
        $this->card = $card;
    }

    public function savePoint(){
        if($this->card){
            $this->pointCard = $this->pointCard . ' ' . $this->priceCard . '$';
            $lastPoints = json_decode($this->card->point_card);
            $newPoints = [];
            $newPoints = $newPoints + $lastPoints;

            array_push($newPoints, $this->pointCard);
            $card = Card::find($this->card->id);
            $card->point_card = json_encode($newPoints);
            $card->save();
            $this->card = $card;
            $this->reset(['pointCard', 'priceCard']);
        }else{
            $this->pointCard = $this->pointCard . ' ' . $this->priceCard . '$';
            $this->card = Card::create([
                'user_id'    => $this->user->id,
                'room_id' => $this->group->id,
                'point_card'  => json_encode([$this->pointCard])
            ]);
            $this->reset(['pointCard', 'priceCard']);
        }
    }

    public function render()
    {
        if($this->card)
            $this->cardInfo = json_decode($this->card->point_card);
        return view('livewire.personal');
    }
}
