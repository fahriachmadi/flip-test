<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disbursements', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->integer('amount')->nullable();
            $table->string('status')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('account_number')->nullable();
            $table->string('beneficiary_name')->nullable();
            $table->string('remark')->nullable();
            $table->string('receipt')->nullable();
            $table->string('time_served')->nullable();
            $table->timestamp('timestamp');
            $table->integer('fee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disbursements');
    }
}
