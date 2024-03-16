<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsCrewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_crew', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member')->unsigned();
            $table->integer('project')->unsigned();
            //$table->integer('role')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('member')->references('id')->on('pillar_members')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('project')->references('id')->on('projects')->onUpdate('cascade')->onDelete('restrict');
            //$table->foreign('role')->references('id')->on('project_crew_roles')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_crew');
    }
}
