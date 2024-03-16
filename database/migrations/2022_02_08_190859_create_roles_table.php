<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_position_id')->unsigned();
            $table->integer('pillar_id')->nullable()->unsigned();
            $table->string('role_name', 100);
            $table->string('role_slug', 25)->unique();
            $table->foreign('member_position_id')->references('id')->on('member_positions');
            $table->foreign('pillar_id')->references('pillar_id')->on('pillar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
