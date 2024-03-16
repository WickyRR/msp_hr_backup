<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_info', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('department',50)->nullable();
            $table->integer('faculty_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('faculty_id')->references('fac_id')->on('faculty')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_info');
    }
}
