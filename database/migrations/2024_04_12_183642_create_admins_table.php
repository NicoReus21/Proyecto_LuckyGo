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
        $timestamps = false;
            
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            //$table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            //$table->timestamps();
        });
    }

    /**
     * Revertir migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
