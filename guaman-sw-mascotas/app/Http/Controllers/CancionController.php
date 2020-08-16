<?php

namespace App\Http\Controllers;
use App\Cancion;
use App\Cliente;
use App\Http\Helper\ResponserBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CancionController extends Controller
{
    public function __construct()
    {
        //
    }

    //

    public function all(){
        $canciones = Cancion::all();
        return ResponserBuilder::result(true,'',$canciones);
    }

    public function get(Request $request, $id){
        $cancion = Cancion::where('id',$id)->first();
        if(!empty($cancion)){
            //carga canciones
            $cancion->cantante;
            return ResponserBuilder::result(true,'',$cancion);
        }else{
            return ResponserBuilder::result(false,'No Encontrado');
        }
    }

    public function create(Request $request){
        if($request->isJson()){
            //verifica el cantante
            $data = $request->json()->all();
            $cantanteId = $data['cantanteId'];
            $cantante = Cliente::where('id',$cantanteId)->first();
            if(!empty($cantante)){
                $cancion = Cancion::create([
                    "nombre"=>$data['nombre'],
                    "cantante_id"=>$data['cantanteId'],
                ]);
                if($cancion->save()){
                    return ResponserBuilder::result(true,'Guardado',$cancion);
                }else{
                    return ResponserBuilder::result(false,'Error al guardar');
                }

            }else{
                return ResponserBuilder::result(false,'Cantante no encontrado');
            }
        }
        return response()->json(['error'=>'Unauthorized'],401,[]);
    }
}
