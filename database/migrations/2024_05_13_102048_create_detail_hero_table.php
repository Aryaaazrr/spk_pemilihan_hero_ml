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
        Schema::create('detail_hero', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hero')->required();
            $table->foreign('id_hero')->references('id_hero')->on('hero')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_kriteria')->required();
            $table->foreign('id_kriteria')->references('id_kriteria')->on('kriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_subkriteria')->required();
            $table->foreign('id_subkriteria')->references('id_subkriteria')->on('subkriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_hero');
    }
};