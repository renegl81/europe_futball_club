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
        Schema::create('clubs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('shortName')->nullable();
            $table->string('code');
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('founded')->nullable();
            $table->string('colors')->nullable();
            $table->string('logo')->nullable();
            $table->foreignId('league_id')->constrained('leagues');
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
        Schema::dropIfExists('clubs');
    }
};
