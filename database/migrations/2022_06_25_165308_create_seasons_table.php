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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->integer('api_id');
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->integer('currentMatchday')->nullable();
            $table->foreignId('league_id')->constrained('leagues');
            $table->foreignId('winner_id')->nullable();
            $table->string('year');
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
        Schema::dropIfExists('seassons');
    }
};
