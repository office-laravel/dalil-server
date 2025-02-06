<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSittingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sittings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nameWebsite' , 30);
            $table->string('linkWebsite' , 128);
            $table->string('Keywords' , 50)->nullable();
            $table->string('Description' , 128)->nullable();
            $table->string('socialMidiaFacebook' , 128)->nullable();
            $table->string('socialMidiaTelegram' , 128)->nullable();
            $table->string('socialMidiaInstagram' , 128)->nullable();
            $table->string('socialMidiaYoutube' , 128)->nullable();
            $table->tinyInteger('insertQuick')->nullable()->default('0');
            $table->string('favicon' , 191)->nullable();
            $table->string('image_default' , 191)->nullable();
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
        Schema::dropIfExists('sittings');
    }
}
