<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $casts = [
        'created_at' => "datetime:d-m-Y H:m:s"
    ];

    public function hotel(){
        return $this->hasOne('App\Hotel','id','hotel_id');
    }
}
