<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersGuestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_guest', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_site')->nullable();
            $table->longText('description')->nullable();
            // $table->string('facebook_link')->nullable();
            // $table->string('twitter_link')->nullable();
            // $table->string('telegram_link')->nullable();
            // $table->string('instagram_link')->nullable();
            // $table->string('youtube_link')->nullable();
            $table->tinyInteger('is_approve')->nullable();
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
        Schema::dropIfExists('orders_guest');
    }
}
