<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKpiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employment_id')->unsigned();
            $table->dateTime('month');
            $table->float('kpi_value');
            $table->integer('marked_by')->unsigned();
            $table->timestamps();
            $table->foreign('employment_id')->references('id')->on('employments')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('marked_by')->references('id')->on('employments')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kpi');
    }
}
