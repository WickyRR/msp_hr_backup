<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKPIScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('k_p_i__scores', function (Blueprint $table) {
            $table->integer('id')->unsigned();;
            $table->string('jan', 50)->default('0');
            $table->string('feb', 50)->default('0');
            $table->string('march', 50)->default('0');
            $table->string('april', 50)->default('0');
            $table->string('may', 50)->default('0');
            $table->string('june', 50)->default('0');
            $table->string('july', 50)->default('0');
            $table->string('aug', 50)->default('0');
            $table->string('sep', 50)->default('0');
            $table->string('oct', 50)->default('0');
            $table->string('nov', 50)->default('0');
            $table->string('dec', 50)->default('0');

            $table->timestamps();
            $table->foreign('id')->references('id')->on('pillar_members')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('k_p_i__scores');
    }
}
