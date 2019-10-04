<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var arrayure
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','picture','department_id','section_id','added_by','emp_id','mobile','extension'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department()
    {
        return $this->hasOne('App\Department','id','department_id');
    }
    public function section()
    {
        return $this->hasOne('App\Section','id','section_id');
    }
    public function role()
    {
        return $this->hasOne('App\Role','id','role_id');
    }

}
