<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpiManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi_managers', function (Blueprint $table) {
            $table->integer('employment_id')->unsigned();
            $table->integer('assigned_pillar_id')->unsigned();
            $table->integer('assigned_year_id')->unsigned();
            $table->timestamps();
            $table->foreign('employment_id')->references('id')->on('employments')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('assigned_pillar_id')->references('pillar_id')->on('pillar')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('assigned_year_id')->references('id')->on('active_years')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi_managers');
    }
}
