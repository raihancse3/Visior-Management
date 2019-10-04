<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleMovement extends Model
{
    protected $table = 'vehicle_movements';

    public function driver()
    {
        return $this->hasOne('App\Driver','id','driver_id');
    }

    public function vehicle()
    {
        return $this->hasOne('App\Vehicle','id','vehicle_id');
    }
}
