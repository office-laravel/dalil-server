<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFixedSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name' , 25);
            $table->string('href' , 128);
            $table->string('photo' , 128);
            $table->integer('country_id')->unsigned();
            $table->tinyInteger('show_status');
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
        Schema::dropIfExists('fixed_sites');
    }
}
