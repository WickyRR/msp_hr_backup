<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            //$table->integer('dept_id')->unsigned();
            // $table->tinyInteger('isApproved')->unsigned();
            // $table->tinyInteger('isActive')->unsigned();
            //$table->foreign('dept_id')->references('dept_id')->on('department')->onUpdate('cascade')->onDelete('cascade');
            //$table->string('short_name',100);
            $table->string('email', 50)->unique();
            $table->integer('user_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_type_id')->references('id')->on('user_types')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
