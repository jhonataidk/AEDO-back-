<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('usuario_orgao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_orgao')->constrained('orgaos')->onDelete('cascade');
            $table->timestamps();

            // Relacionamento com a tabela enderecos

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
