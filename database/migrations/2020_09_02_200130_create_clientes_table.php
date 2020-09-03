<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('endereco');
            $table->string('nome', 255);
            $table->string('cpfCnpj', 14)->unique();
            $table->string('email', 255);
            $table->char('tipoPessoa', 1);
            $table->timestamps();

            $table->foreign('endereco')->references('id')->on('enderecos')->onDelete(('CASCADE'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
