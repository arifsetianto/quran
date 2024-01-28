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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('total_verses');
            $table->smallInteger('start');
            $table->string('name', 50);
            $table->string('tname', 50);
            $table->string('ename', 50);
            $table->enum('type', ['meccan', 'medinan']);
            $table->smallInteger('order');
            $table->smallInteger('rukus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
