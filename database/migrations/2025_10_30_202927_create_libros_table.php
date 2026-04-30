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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('slug'); 
            // $table->unique(['slug', 'deleted_at']); cambio
            $table->string('volumen')->nullable();
            $table->year('anio')->nullable();
            $table->text('resumen')->nullable();
            $table->text('cita')->nullable();
            $table->string('isbn')->nullable();
            $table->string('isbn_coleccion')->nullable();
            $table->text('palabras_clave')->nullable();
            $table->text('resena')->nullable();
            $table->string('doi')->nullable();
            $table->string('pdf')->nullable();
            $table->string('imagen')->nullable();
            $table->boolean('estado')->default(true);
            $table->foreignId('series_id')->nullable()->constrained('series')->onDelete('set null');
            $table->foreignId('tipos_id')->nullable()->constrained('tipos')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
