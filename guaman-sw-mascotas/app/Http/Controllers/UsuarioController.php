<?php

namespace App\Http\Controllers;
use App\Http\Helper\ResponserBuilder;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function __construct()
    {
        //
    }

    public function login(Request $request){
        $usuario = $request->usuario;
        $clave = $request->password;
        $user = Usuario::where('username', $usuario)->first();
        $status =false;
        $info='User is incorrect';
        $token='';
        if(!empty($user)){
            $suc = $this->django_password_verify($clave, $user->password);

            if($suc){
                $cliente=$user->cliente;
                $token=Str::random(60);
                $cliente->token=$token;
                $cliente->save();
                $status=true;
                $info='User is correct';
            }
        }
        return ResponserBuilder::result($status,$info,$token);
    }


    private function verify_Password($dbString, $password)
    {
        return password_verify($password,$dbString);
    }
    function django_password_verify(string $password, string $djangoHash): bool
    {
        $pieces = explode('$', $djangoHash);
        if (count($pieces) !== 4) {
            throw new Exception("Illegal hash format");
        }
        list($header, $iter, $salt, $hash) = $pieces;
        // Get the hash algorithm used:
        if (preg_match('#^pbkdf2_([a-z0-9A-Z]+)$#', $header, $m)) {
            $algo = $m[1];
        } else {
            throw new Exception(sprintf("Bad header (%s)", $header));
        }
        if (!in_array($algo, hash_algos())) {
            throw new Exception(sprintf("Illegal hash algorithm (%s)", $algo));
        }

        $calc = hash_pbkdf2(
            $algo,
            $password,
            $salt,
            (int) $iter,
            32,
            true
        );
        return hash_equals($calc, base64_decode($hash));
    }
    public function salir(){
       Auth::user()->token='';
       Auth::user()->save();
        return ResponserBuilder::result(true,'Usted ha salido');
    }
}
