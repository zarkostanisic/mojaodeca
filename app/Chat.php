<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'user_from_id', 'chat', 'user_to_id','conversation_id',
    ];
}
