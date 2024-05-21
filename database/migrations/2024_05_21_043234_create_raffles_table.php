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
        Schema::create('raffles', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->integer('winner_number');
            $table->integer('ticket_quantity');
            $table->date('date');
            $table->integer('will_be_lucky');
            $table->integer('subtotal');
            $table->unsignedBigInteger('rafflertor_id');
            $table->timestamps();

            // clave foranea
            $table->foreign('rafflertor_id')->references('id')->on('raffletors');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffles');
    }
};
