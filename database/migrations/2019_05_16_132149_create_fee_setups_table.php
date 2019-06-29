<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_setups', function (Blueprint $table) {
            $table->increments('id');

            $table->string('class_id',20);
            $table->integer('academic_year_id');
            $table->string('type',20);
            $table->string('title',100);
            $table->decimal('fee',18,2);
            $table->decimal('Latefee',18,2)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('fee_setups');
    }
}
