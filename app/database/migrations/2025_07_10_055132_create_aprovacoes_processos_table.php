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
        Schema::create('aprovacoes_processos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('processo_id');
            $table->unsignedBigInteger('signatario_id');
            $table->enum('status', ['aprovado', 'reprovado', 'pendente']);
            $table->timestamp('data_hora')->useCurrent();
            $table->text('justificativa')->nullable();
            $table->timestamps();

            $table->foreign('processo_id')->references('id')->on('processos')->onDelete('cascade');
            $table->foreign('signatario_id')->references('id')->on('signatarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aprovacoes_processos');
    }
};
