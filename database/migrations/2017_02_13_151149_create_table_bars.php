<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bars', function(Blueprint $table) {
           $table->increments('id');
           $table->integer('challenge_id')->unsigned();
           $table->string('name');
           $table->text('description')->nullable();
           $table->string('postcode')->nullable();
           $table->string('lat')->nullable();
           $table->string('lng')->nullable();
           $table->string('stime');
           $table->string('etime');
           $table->timestamps();

            $table->foreign('challenge_id')->references('id')->on('challenges')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bars');
    }
}
