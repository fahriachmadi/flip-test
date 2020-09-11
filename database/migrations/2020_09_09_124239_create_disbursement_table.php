<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursement', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->integer('amount');
            $table->string('status');
            $table->string('bank_code');
            $table->string('account_number');
            $table->string('beneficiary_name');
            $table->string('remark');
            $table->string('receipt');
            $table->timestamp('time_served');
            $table->timestamp('timestamp');
            $table->integer('fee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disbursement');
    }
}
