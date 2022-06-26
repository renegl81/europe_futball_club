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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->integer('api_id')->nullable();
            $table->foreignId('season_id')->constrained('seasons');
            $table->foreignId('home_id')->constrained('teams');
            $table->foreignId('away_id')->constrained('teams');
            $table->string('day');
            $table->string('status');
            $table->string('stage')->nullable();
            $table->string('group')->nullable();
            $table->integer('matchDay');
            $table->string('winner')->nullable();
            $table->integer('homeScore')->default(0);
            $table->integer('awayScore')->default(0);
            $table->integer('homeHalfScore')->default(0);
            $table->integer('awayHalfScore')->default(0);
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
        Schema::dropIfExists('games');
    }
};
