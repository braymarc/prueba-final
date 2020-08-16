<?php

namespace App\Http\Controllers;

use App\Http\Helper\ResponserBuilder;
use App\Http\Helpers\Security;
use App\Turno;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TurnoController extends Controller
{
    public function __construct()
    {
        //
    }

    public function create(Request $request){
        if($request->isJson()){
            //verifica el cantante

            $usuario = Auth::user();
            $turno = Turno::create([
                'mascota_id'=>$request->mascota_id,
                'estado'=>'En Espera',
            ]);

            //agregamos al grupo

            if($turno->save()){
                return ResponserBuilder::result(true,'Guardado',$turno);
            }else{
                return ResponserBuilder::result(false,'Error al guardar');
            }
        }
        return response()->json(['error'=>'Unauthorized'],401,[]);
    }
}
