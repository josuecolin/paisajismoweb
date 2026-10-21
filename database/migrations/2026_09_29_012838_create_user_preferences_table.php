<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('p1');
            $table->unsignedTinyInteger('p2');
            $table->unsignedTinyInteger('p3');
            $table->unsignedTinyInteger('p4');
            $table->unsignedTinyInteger('p5');
            $table->unsignedTinyInteger('p6');
            $table->unsignedTinyInteger('p7');
            $table->unsignedTinyInteger('p8');
            $table->unsignedTinyInteger('p9');
            $table->unsignedTinyInteger('p10');
            $table->unsignedTinyInteger('p11');
            $table->unsignedTinyInteger('p12');
            $table->unsignedTinyInteger('p13');
            $table->unsignedTinyInteger('p14');
            $table->unsignedTinyInteger('p15');

            $table->timestamps();

            $table->unique('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
