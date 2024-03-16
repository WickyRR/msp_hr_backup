<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitPillarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruit_pillar', function (Blueprint $table) {
            $table->integer('recruit_id')->unsigned();
            $table->integer('pillar_id')->unsigned();
            $table->foreign('pillar_id')->references('pillar_id')->on('pillar')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('recruit_id')->references('recruit_id')->on('recruit')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruit_pillar');
    }
}
