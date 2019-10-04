<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
   public function getPossition()
    {
        return $this->hasOne('App\Possition','id','possition_id');
    }
}
