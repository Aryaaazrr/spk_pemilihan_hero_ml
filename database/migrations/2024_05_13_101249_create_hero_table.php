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
        Schema::create('hero', function (Blueprint $table) {
            $table->id('id_hero');
            $table->string('nama')->notNull();
            $table->string('foto')->notNull();
            $table->enum('role', ['Tank', 'Fighter', 'Assassin', 'Mage', 'Marksman', 'Support'])->notNull();
            $table->enum('laning', ['Roam', 'Jungle', 'Gold Lane', 'EXP Lane', 'Mid Lane'])->notNull();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero');
    }
};
