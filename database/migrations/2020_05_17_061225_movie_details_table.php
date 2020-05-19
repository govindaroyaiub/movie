<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MovieDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_details', function (Blueprint $table) {
            $table->id();
            $table->string('movie_title')->nullable();
            $table->longText('movie_description_short')->nullable();
            $table->longText('movie_description_long')->nullable();
            $table->date('cinema_date')->nullable();
            $table->string('director')->nullable();
            $table->longText('actors')->nullable();
            $table->longText('youtube_url')->nullable();
            $table->longText('image1')->nullable();
            $table->longText('image2')->nullable();
            $table->longText('image3')->nullable();
            $table->longText('duration')->nullable();
            $table->string('ratings')->nullable();
            $table->longText('base_url')->nullable();
            $table->longText('ticket_url')->nullable();
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
        Schema::dropIfExists('movie_details');
    }
}
