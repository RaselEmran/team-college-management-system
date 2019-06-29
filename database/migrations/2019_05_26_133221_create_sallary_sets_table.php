<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSallarySetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sallary_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id');
            $table->integer('employee_id');
            $table->string('basic_sallary');
            $table->string('house_rent');
            $table->string('medical_allowance');
            $table->string('Transport_allowance');
            $table->string('insurance');
            $table->string('extra_over_time');
            $table->string('total');
            $table->string('status');
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
        Schema::dropIfExists('sallary_sets');
    }
}
