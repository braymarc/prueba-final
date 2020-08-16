<?php

namespace App\Http\Controllers;
use App\Cancion;
use App\Cliente;
use App\Http\Helper\ResponserBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CantanteController extends Controller
{
    public function __construct()
    {
        //
    }

    //

    public function all(){
        $cantantes = Cliente::all();
        return ResponserBuilder::result(true,'',$cantantes);
    }


    public function getCantante(Request $request, $cedula){
        $cantante = Cliente::where('cedula',$cedula)->first();
        if(!empty($cantante)){
            //carga canciones
            $cantante->canciones;
            return ResponserBuilder::result(true,'',$cantante);
        }else{
            return ResponserBuilder::result(false,'No Encontrado');
        }
    }

    public function create(Request $request){
        if($request->isJson()){
            //verifica el cantante
            $data = $request->json()->all();
            $cantante = Cliente::create([
                "cedula"=>$data['cedula'],
                "nombre"=>$data['nombre'],
            ]);
            if($cantante->save()){
                return ResponserBuilder::result(true,'Guardado',$cantante);
            }else{
                return ResponserBuilder::result(false,'Error al guardar');
            }
        }
        return response()->json(['error'=>'Unauthorized'],401,[]);
    }
}
