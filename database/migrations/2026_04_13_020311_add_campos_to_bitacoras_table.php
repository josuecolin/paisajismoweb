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
        Schema::table('bitacoras', function (Blueprint $table) {
    $table->unsignedBigInteger('user_id')->nullable();
    $table->string('accion');
    $table->string('tabla');
    $table->unsignedBigInteger('registro_id')->nullable();
    $table->text('descripcion')->nullable();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bitacoras', function (Blueprint $table) {
            //
        });
    }
};
