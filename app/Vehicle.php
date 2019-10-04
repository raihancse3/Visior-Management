<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
   protected $table = 'vehicles';
   public function pusrchase_order()
    {
        //return $this->hasMany(PurchaseOrder::class, 'supplier_id');
    }
}
