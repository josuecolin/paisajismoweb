<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('area_m2', 10, 2)->nullable();
            $table->string('status', 20)->default('borrador'); // borrador, cotizado, aprobado
            $table->decimal('labor_percent', 5, 2)->default(25);
            $table->decimal('contingency_percent', 5, 2)->default(5);
            $table->decimal('tax_percent', 5, 2)->default(16);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
