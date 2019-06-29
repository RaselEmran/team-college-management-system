<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSallaryPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sallary_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('employee_id');
            $table->string('pay_date');
            $table->string('pay_month');
            $table->string('pay_amt');
            $table->string('mode');
            $table->string('check_num')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('sallary_payments');
    }
}
