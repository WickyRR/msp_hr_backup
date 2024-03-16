<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceRequestMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_request_media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('media_path',200);
            $table->integer('request_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('request_id')->references('id')->on('finance_requests')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_request_media');
    }
}
