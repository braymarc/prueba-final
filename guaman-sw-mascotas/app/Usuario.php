<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Usuario extends Model
{
    protected $table = 'auth_user';
    public $timestamps = false;

    protected $fillable=[
        'password','username','first_name','last_name','email','is_superuser','is_superuser','is_staff','is_active','date_joined'
    ];

    protected $hidden=[
        'id'
    ];

    public function cliente()
    {
        return $this->hasOne('App\Cliente','user_id','id');
    }

    public function grupos()
    {
        return $this->belongsToMany('App\Grupo','auth_user_groups','group_id','user_id');
    }
}
