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
        Schema::create('wars', function (Blueprint $table) {
            $table->id();
            $table->string('war_id')->unique();
            $table->unsignedInteger('war_number');
            $table->tinyInteger('winner')->default(0);
            $table->timestamp('conquest_start_time');
            $table->timestamp('conquest_end_time')->nullable();
            $table->timestamp('resistance_start_time')->nullable();
            $table->unsignedInteger('required_victory_towns')->default(32);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wars');
    }
};
