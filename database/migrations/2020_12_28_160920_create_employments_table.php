<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            //$table->integer('member_position_id')->unsigned();
            $table->integer('active_year_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            //$table->foreign('member_position_id')->references('id')->on('member_positions')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('active_year_id')->references('id')->on('active_years')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employments');
    }
}
