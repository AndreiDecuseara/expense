<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'owner_id',
        'slug'
    ];

    public function cards(){
        return $this->hasMany(Card::class, 'room_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
