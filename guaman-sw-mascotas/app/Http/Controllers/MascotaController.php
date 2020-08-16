<?php

namespace App\Http\Controllers;
use App\Cancion;
use App\Cliente;
use App\Http\Helper\ResponserBuilder;
use App\Http\Helpers\Security;
use App\Mascota;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MascotaController extends Controller
{
    public function __construct()
    {
        //
    }

    public function create(Request $request){
        if($request->isJson()){
            //verifica el cantante
            $usuario = Auth::user();
            var_dump($usuario->cliente_id);
            $mascota = Mascota::create([
                'nombre'=>$request->nombre,
                'raza'=>$request->raza,
                'altura'=>$request->altura,
                'tipo'=>$request->tipo,
                'cliente_id'=>$usuario->cliente_id
            ]);

            if($mascota->save()){
                return ResponserBuilder::result(true,'Guardado',$mascota);
            }else{
                return ResponserBuilder::result(false,'Error al guardar');
            }
        }
        return response()->json(['error'=>'Unauthorized'],401,[]);
    }

    public function getAll(){
        $mascotas = Mascota::all();
        return ResponserBuilder::result(true,'',$mascotas);
    }
}
