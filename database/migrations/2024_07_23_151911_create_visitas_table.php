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
        Schema::create('visitas', function (Blueprint $table) {
            
            $table->id();
            $table->unsignedBigInteger('prisionero_id');
            $table->unsignedBigInteger('visitante_id');
            $table->unsignedBigInteger('guardia_id');
            $table->foreign('prisionero_id')->references('id')->on('prisioneros');
            $table->foreign('visitante_id')->references('id')->on('visitantes');
            $table->foreign('guardia_id')->references('id')->on('guardias');
            $table->dateTime('fecha_hora_inicio');
            $table->dateTime('fecha_hora_fin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
    }
};
