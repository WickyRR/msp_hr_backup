<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentsPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { {
            Schema::create('employments_permissions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('employment_id')->unsigned();
                $table->integer('permission_id')->unsigned();

                $table->foreign('employment_id')->references('id')->on('employments');
                $table->foreign('permission_id')->references('id')->on('permissions');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employments_permissions');
    }
}
