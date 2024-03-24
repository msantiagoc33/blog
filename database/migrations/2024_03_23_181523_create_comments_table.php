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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // Clave foránea para la relación con el post
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clave foránea para la relación con el usuario que hizo el comentario
            $table->text('body'); // El contenido del comentario
            $table->timestamps(); // Columnas para registrar la fecha de creación y actualización del comentario
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
