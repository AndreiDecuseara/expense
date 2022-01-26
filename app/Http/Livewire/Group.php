<?php

namespace App\Http\Livewire;

use App\Models\Card;
use App\Models\Group as ModelsRoom;
use App\Models\User;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Helpers\Helper;

class Group extends Component
{

    public $group;
    public $user;
    public $card;
    public $cardInfo;
    public $anonim = false;
    public $endTrip = 0;

    public $pointCard;
    public $priceCard;

    protected $listeners = ['refreshThis' => '$refresh'];

    public function mount($group, $user){
        $this->group = ModelsRoom::where('slug', $group)->latest()->first();
        $this->user = User::where('id', $user)->first();
        $this->card = Card::where('user_id', $this->user->id)->where('room_id', $this->group->id)->first();
        $this->endTrip = $this->group->end_trip;
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
            $this->card = Card::create([
                'user_id'    => $this->user->id,
                'room_id' => $this->group->id,
                'point_card'  => json_encode([$this->pointCard])
            ]);
            $this->reset('pointCard');
        }
    }

    public function deleteInfo($key){
        $lastPoints = json_decode($this->card->point_card);
        $card = Card::find($this->card->id);
        array_splice($lastPoints, $key, 1);
        $card->point_card = json_encode($lastPoints);
        $card->save();
        $this->card = $card;
    }

    public function reveal(){
        $group = ModelsRoom::find($this->group->id);
        $this->endTrip = 1;
        $group->end_trip = 1;
        $group->save();
        $this->group = $group;
    }

    public function closeReveal(){
        $group = ModelsRoom::find($this->group->id);
        $this->endTrip = 0;
        $group->end_trip = 0;
        $group->save();
        $this->group = $group;
    }

    public function render()
    {
        if($this->card)
            $this->cardInfo = json_decode($this->card->point_card);
        return view('livewire.group')->layout('layouts.app',['roomCode' => $this->group->slug]);
    }
}
