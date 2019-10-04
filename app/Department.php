<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public $timestamps = false;

    public function section()
    {
        return $this->hasMany(Section::class);
    }

    
}
