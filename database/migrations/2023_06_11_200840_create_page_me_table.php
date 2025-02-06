<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageMeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_me', function (Blueprint $table) {
            // $table->increments('id');
            // $table->string('name')->nullable();
            // $table->string('href')->nullable();

            // $table->unsignedBigInteger('users_id'); // Change this line
            // $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');

            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_me');
    }
}
