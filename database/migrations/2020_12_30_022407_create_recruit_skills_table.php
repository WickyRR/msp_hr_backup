<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruit_skills', function (Blueprint $table) {
            $table->integer('recruit_id')->unsigned();
            $table->integer('skill_id')->unsigned();
            $table->foreign('skill_id')->references('skill_id')->on('skills')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('recruit_skills');
    }
}
