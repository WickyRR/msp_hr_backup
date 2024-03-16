<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePillarMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pillar_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 150);
            $table->string('nearest_town', 50);
            $table->string('contact_number', 15);
            $table->integer('pillar')->unsigned();;
            $table->integer('faculty')->unsigned();;
            $table->string('batch', 20);
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->date('birthday');
            $table->string('photo_url');
            $table->integer('district_id')->unsigned();
            $table->timestamps();
            $table->foreign('district_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('pillar')->references('pillar_id')->on('pillar')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('faculty')->references('fac_id')->on('faculty')->onUpdate('cascade')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pillar_members');
    }
}
