<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruit_processes', function (Blueprint $table) {
            $table->increments('recruit_process_id');
            $table->string('process_name',40);
            $table->text('instructions')->nullable();
            $table->string('contact_details',100);
            $table->integer('year_id')->unsigned();
            $table->dateTime('start_date');
            $table->dateTime('close_date');
            $table->tinyInteger('process_status')->unsigned()->comment('0 - Closed, 1 - Open');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('year_id')->references('id')->on('active_years')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruit_processes');
    }
}
