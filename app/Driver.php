<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
   protected $table = 'vdrivers';
   
   public function vehicle()
    {
        return $this->hasOne('App\Vehicle','id','vehicle_id');
    }
}
