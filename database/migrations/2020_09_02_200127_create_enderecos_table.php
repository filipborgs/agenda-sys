<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('cliente');
            $table->unsignedBigInteger('bairro');
            $table->string('cep', 8);
            $table->string('logadouro', 120);
            $table->string('complemento', 60);
            $table->string('numero', 7);
            $table->timestamps();

            // $table->foreign('cliente')->references('id')->on('clientes')->onDelete('CASCADE');
            $table->foreign('bairro')->references('id')->on('bairros')->onDelete(('CASCADE'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
