<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShowLocationStaticTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('show_location_static', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->longText('address')->nullable();
            $table->string('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->longText('url')->nullable();
            $table->longText('image')->nullable();
            $table->tinyInteger('is_deleted')->default('0');
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
        Schema::dropIfExists('show_location_static');
    }
}
