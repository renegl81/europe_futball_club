<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players');
            $table->foreignId('season_id')->constrained('seasons');
            $table->integer('goals')->nullable();
            $table->integer('assists')->nullable();
            $table->integer('penalties')->nullable();
            $table->integer('yellowCards')->nullable();
            $table->integer('redCards')->nullable();
            $table->integer('foulsCommitted')->nullable();
            $table->integer('foulsReceived')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_stats');
    }
};
