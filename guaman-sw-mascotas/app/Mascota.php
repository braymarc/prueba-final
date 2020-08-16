<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Mascota extends Model
{
    protected $table = 'modelos_mascota';
    protected $primaryKey = 'mascota_id';
    public $timestamps = false;

    protected $fillable=[
        'nombre','raza','altura','tipo','cliente_id','mascota_id'
    ];

    protected $hidden = [

    ];
    public function cliente()
    {
        return $this->belongsTo('App\Cliente','cliente_id','cliente_id');
    }

}
