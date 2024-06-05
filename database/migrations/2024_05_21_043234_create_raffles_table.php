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
        Schema::create('raffles', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->string('winner_number');
            $table->integer('ticket_quantity');
            $table->date('date');
            $table->integer('will_be_lucky');
            $table->integer('subtotal');
            $table->unsignedBigInteger('raffletor_id')->nullable();
            $table->timestamps();

            // clave foranea con tabla raffletors.
            $table->foreign('raffletor_id')->references('id')->on('raffletors');
        });
    }
    
    /**
     * Revertir migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffles');
    }
};
