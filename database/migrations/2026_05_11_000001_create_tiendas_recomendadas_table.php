<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tiendas_recomendadas', function (Blueprint $table) {
            $table->id();

            // Relación con categorías (una tienda puede pertenecer a varias)
            // La tabla pivot maneja la relación many-to-many
            $table->string('nombre');
            $table->string('tipo');           // Ej: "Vivero especializado"
            $table->text('descripcion');
            $table->string('icono')->default('🏪');   // Emoji
            $table->string('color', 10)->default('#2d6a4f'); // Color HEX
            $table->string('sitio_web')->nullable();         // URL
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Tabla pivot: una tienda puede estar en varias categorías
        Schema::create('categoria_tienda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->onDelete('cascade');
            $table->foreignId('tienda_id')
                  ->constrained('tiendas_recomendadas')
                  ->onDelete('cascade');
            $table->unique(['categoria_id', 'tienda_id']);
        });

        // Tags de cada tienda
        Schema::create('tienda_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tienda_id')
                  ->constrained('tiendas_recomendadas')
                  ->onDelete('cascade');
            $table->string('tag');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tienda_tags');
        Schema::dropIfExists('categoria_tienda');
        Schema::dropIfExists('tiendas_recomendadas');
    }
};
