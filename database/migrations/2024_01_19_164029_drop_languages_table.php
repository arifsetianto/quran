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
        Schema::table('translations', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
        });

        Schema::table('translations', function (Blueprint $table) {
            $table->dropColumn('language_id');
        });

        Schema::dropIfExists('languages');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 2);
            $table->string('name', 50);
            $table->boolean('enabled')->default(false);
        });

        Schema::table('translations', function (Blueprint $table) {
            $table->foreignId('language_id')->nullable()->constrained();
        });
    }
};
