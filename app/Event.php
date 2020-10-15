<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{ 
    protected $fillable = [
        'image', 'title', 'description', 'time','loction', 'locationName', 'about'
    ];

    public function speakar(){
        return $this->belongsTo('App\Speakar', 'event_id');
    }
}


