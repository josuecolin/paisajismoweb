<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        // 1. TABLA PRINCIPAL DE CATEGORÍAS
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');           // Ej: "Jardines Tropicales"
            $table->string('slug')->unique();   // Ej: "jardines-tropicales"
            $table->text('descripcion')->nullable();
            $table->string('icono')->nullable(); // emoji o clase de icono
            $table->string('color', 7)->default('#4A7C2F'); // color HEX
            $table->timestamps();
        });
 
        // 2. TABLA PIVOTE: categoría ↔ publicación (many-to-many)
        Schema::create('categoria_post', function (Blueprint $table) {
            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->cascadeOnDelete();
            $table->foreignId('post_id')
                  ->constrained('posts')
                  ->cascadeOnDelete();
            $table->primary(['categoria_id', 'post_id']);
        });
 
        // 3. TABLA PIVOTE: categoría ↔ usuario (preferencias, many-to-many)
        Schema::create('categoria_user', function (Blueprint $table) {
            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->cascadeOnDelete();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();
            $table->primary(['categoria_id', 'user_id']);
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('categoria_user');
        Schema::dropIfExists('categoria_post');
        Schema::dropIfExists('categorias');
    }
};
