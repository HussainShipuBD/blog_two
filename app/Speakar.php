<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speakar extends Model
{
    protected $fillable = [
        'image', 'name', 'profession', 'event_id'
    ];
}
