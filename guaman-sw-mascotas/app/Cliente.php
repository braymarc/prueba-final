<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Cliente extends Model
{
    protected $table = 'modelos_cliente';
    protected $primaryKey = 'cliente_id';
    public $timestamps = false;

    protected $fillable=[
        'cedula','celular','direccion','user_id','token'
    ];
    protected $hidden = [
        'cliente_id'
    ];
    public function mascotas()
    {
        return $this->hasMany('App\Mascota','cliente_id','cliente_id');
    }


    public function usuario()
    {
        return $this->belongsTo('App\Usuario','user_id','id');
    }

}
