<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('billNo',20);
            $table->string('regi',50);
            $table->string('title',100);
            $table->string('month',5);
            $table->decimal('fee',18,2);
            $table->decimal('lateFee',18,2);
            $table->decimal('total',18,2);
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
        Schema::dropIfExists('fee_histories');
    }
}
