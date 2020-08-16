<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    public function up()
    {
        Schema::create('usuarios', function(Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('usuario', 100);
            $table->string('password', 250);
            $table->string('token', 250)->default('');
            // Constraints declaration
        });
    }

    public function down()
    {
        Schema::drop('usuarios');
    }
}
