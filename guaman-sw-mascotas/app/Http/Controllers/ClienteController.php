<?php

namespace App\Http\Controllers;
use App\Cancion;
use App\Cliente;
use App\Http\Helper\ResponserBuilder;
use App\Http\Helpers\Security;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClienteController extends Controller
{
    public function __construct()
    {
        //
    }

    public function create(Request $request){
        if($request->isJson()){
            //verifica el cantante
            $password = $request->password;
            $is_superuser = 0;
            $username = $request->username;
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $email = $request->email;
            $is_staff = 0;
            $is_active = 1;
            $usuario = Usuario::create([
                "password"=>Security::make_password($password),
                "is_superuser"=>$is_superuser,
                "username"=>$email,
                "first_name"=>$first_name,
                "last_name"=>$last_name,
                "email"=>$email,
                "is_staff"=>$is_staff,
                "is_active"=>$is_active,
                "date_joined"=>date("Y-m-d H:i:s"),
            ]);
            $usuario->save();

            $cliente = Cliente::create([
                'cedula'=>$request->cedula,
                'celular'=>$request->celular,
                'direccion'=>$request->direccion,
                'token'=>'',
                'user_id'=>$usuario->id
            ]);

            DB::table('auth_user_groups')->insert(
                ['user_id' => $usuario->id, 'group_id' => 1]
            );

            //agregamos al grupo

            if($cliente->save()){
                return ResponserBuilder::result(true,'Guardado',$usuario);
            }else{
                return ResponserBuilder::result(false,'Error al guardar');
            }
        }
        return response()->json(['error'=>'Unauthorized'],401,[]);
    }
}
