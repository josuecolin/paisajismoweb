<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->timestamp('questionnaire_completed_at')
                ->nullable();

            $table->integer('cluster_ml')
                ->nullable();

            $table->string('perfil_ml')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'questionnaire_completed_at',
                'cluster_ml',
                'perfil_ml'
            ]);
        });
    }
};