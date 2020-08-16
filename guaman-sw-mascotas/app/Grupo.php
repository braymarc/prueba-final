<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Grupo extends Model
{
    protected $table = 'auth_group';
    public $timestamps = false;

    protected $fillable=[
        'name'
    ];

    protected $hidden=[
        'id'
    ];

    public function usuarios()
    {
        return $this->belongsToMany('App\Usuario','auth_user_groups','user_id','group_id');
    }
}
