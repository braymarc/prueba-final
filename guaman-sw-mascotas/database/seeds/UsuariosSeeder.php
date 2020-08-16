<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'nombre' => 'Brayan',
            'usuario' => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
        ]);
    }
}
