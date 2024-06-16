<?php

use App\Models\admin;
use Dotenv\Repository\Adapter\AdapterInterface;
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
        Schema::create('raffletors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('age');
            $table->string('password');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('admin_id');
            $table->rememberToken();
            $table->timestamps();

            // Clave foranea con tabla admins.
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    /**
     * Revertir migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('raffletors');
    }
};
