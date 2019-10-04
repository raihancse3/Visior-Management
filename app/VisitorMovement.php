<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitorMovement extends Model
{
    protected $table = 'visitor_movements';

    public function visitor()
    {
        return $this->hasOne('App\Visitor','id','visitor_id');
    }

    public function contact_user()
    {
        return $this->hasOne('App\User','id','contact_person');
    }
}
