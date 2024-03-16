<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkspaceMailAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workspace_mail_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email_username')->unique();
            $table->string('enc_password');
            $table->integer('pillar_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('pillar_id')->references('pillar_id')->on('pillar')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workspace_mail_addresses');
    }
}
