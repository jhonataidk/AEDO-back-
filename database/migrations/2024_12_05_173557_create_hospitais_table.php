<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitaisTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hospitais', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('id_endereco'); // Chave estrangeira para endereços
            $table->string('telefone');
            $table->string('email')->unique();
            $table->unsignedBigInteger('criado_por')->nullable(); // Chave estrangeira para usuários
            $table->timestamps();

            // Relacionamento com a tabela enderecos
            $table->foreign('id_endereco')->references('id')->on('enderecos')->onDelete('cascade');

            // Relacionamento com a tabela users
            $table->foreign('criado_por')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hospitais');
    }
}
