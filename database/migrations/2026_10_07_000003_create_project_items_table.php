<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('material_id')->constrained()->restrictOnDelete();
            $table->decimal('quantity', 12, 2);
            $table->decimal('unit_price', 12, 2); // precio congelado al momento de agregar
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->unique(['project_id', 'material_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_items');
    }
};
