<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->index(); // plantas, pasto, piedra, sustrato, riego, iluminacion, mobiliario, estructuras
            $table->string('unit', 10);          // m2, m3, pza, kg, ml
            $table->decimal('unit_price', 12, 2);
            $table->string('supplier')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
