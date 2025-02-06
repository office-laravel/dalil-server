<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('site_name' , 50);
            $table->string('href' , 128);
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('title' , 25);
            $table->longText('description')->nullable();
            $table->longText('articale')->nullable();
            $table->integer('countries_id')->unsigned();
            $table->integer('subcategories')->nullable();
            $table->foreign('subcategories')->references('id')->on('categories')->onDelete('cascade');
            $table->string('keyword' , 256)->nullable();;
            $table->string('facebook' , 128)->nullable();
            $table->string('twitter' , 128)->nullable();
            $table->string('instagram' , 128)->nullable();
            $table->string('snapchat' , 128)->nullable();
            $table->string('youtube' , 128)->nullable();
            $table->string('telegram' , 128)->nullable();
            $table->string('LinkedIn' , 128)->nullable();
            $table->string('android' , 128)->nullable();
            $table->string('ios' , 128)->nullable();
            $table->bigInteger('views')->nullable();
            $table->bigInteger('priority')->nullable();
            $table->timestamps();
            $table->boolean('confirmed')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
