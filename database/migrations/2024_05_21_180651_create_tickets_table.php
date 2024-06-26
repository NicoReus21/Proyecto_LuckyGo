<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Inicialización de migraciones.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('content');
            $table->boolean('is_will_be_luck');
            $table->unsignedBigInteger('raffle_id');
            $table->timestamps();

            // clave foranea con tabla raffles.
            $table->foreign('raffle_id')->references('id')->on('raffles');

        });
    }

    /**
     * Revertir migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
