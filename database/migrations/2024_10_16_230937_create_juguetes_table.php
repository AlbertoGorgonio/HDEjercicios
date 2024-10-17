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
        Schema::create('juguetes', function (Blueprint $table) {
            $table->id(); // Clave primaria (auto incremental)
            $table->string('nombre'); // Nombre del juguete
            $table->string('categoria'); // Puede ser "niño" o "niña"
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juguetes'); // Elimina la tabla en caso de rollback
    }
};
