<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDormitoryfeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dormitoryfees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dormitory_id',20);
            $table->string('regi_no',20);
            $table->string('month');
            $table->string('paydate');
            $table->decimal('feeAmount',10,2);
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
        Schema::dropIfExists('dormitoryfees');
    }
}
