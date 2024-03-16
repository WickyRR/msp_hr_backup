<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employment_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->text('description')->nullable();
            $table->decimal('total_amount');
            $table->integer('status_id')->unsigned();
            $table->dateTime('request_date');
            $table->integer('inspected_by')->unsigned();
            $table->string('payee_name',50);
            $table->string('payee_bank_details',300);
            $table->string('account_number',40);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('employment_id')->references('id')->on('employments')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('category_id')->references('id')->on('finance_request_categories')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('status_id')->references('id')->on('finance_request_status')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('inspected_by')->references('id')->on('employments')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finance_requests');
    }
}
