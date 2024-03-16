<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruit', function (Blueprint $table) {
            $table->increments('recruit_id');
            $table->string('full_name', 150);
            $table->string('name', 100);
            $table->string('index_no', 10)->nullable();
            $table->string('email', 50);
            $table->string('contact_no', 15);
            $table->integer('fac_id')->unsigned();
            $table->string('department', 50);
            $table->tinyInteger('batch')->unsigned();
            $table->tinyInteger('is_old_member')->unsigned()->comment("0 - not an old member, 1 - an old member");
            $table->text('prev_projects')->nullable();
            $table->text('sports_do')->nullable();
            $table->text('drive_link')->nullable();
            $table->text('clubs')->nullable();
            $table->text('achievements')->nullable();
            $table->string('cv', 200);
            $table->tinyInteger('apply_status')->unsigned()->comment("0 - applied, 1 - rejected, 2 - recruited");
            $table->integer('process_id')->unsigned();
            $table->timestamp('timestamp');
            $table->foreign('fac_id')->references('fac_id')->on('faculty')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('process_id')->references('recruit_process_id')->on('recruit_processes')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruit');
    }
}
