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
        Schema::create('pokemones', function (Blueprint $table) {
            $table->id('id_pokemon');
            $table->string('nombre');
            $table->string('tipo');
            $table->string('region');
            $table->string('descripcion');
            $table->integer('edad');
            $table->integer('peso');
            $table->unsignedBigInteger('id_entrenador');
            $table->timestamps();
            $table->foreign('id_entrenador')->references('id_entrenador')->on('entrenadors')->onDelete('cascade'); // Definimos la relación con la tabla de entrenadores

            //$table->foreign('id_tema')->references('id_tema')->on('temas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemones');
    }
};
