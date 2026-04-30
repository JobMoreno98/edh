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
        Schema::create('capitulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('libro_id')->constrained('libros')->onDelete('cascade');
            $table->foreignId('autor_id')->nullable()->constrained('autores')->nullOnDelete();
            // $table->foreignId('autor_id')->constrained('autores')->nullable(); //el autores nullable parece no estar funcionando, no lo pasa a la base de datos y la base lo pide.
            //incorrecto arriba por el orden
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->text('cita_articulo')->nullable();
            $table->boolean('estado')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capitulos');
    }
};
