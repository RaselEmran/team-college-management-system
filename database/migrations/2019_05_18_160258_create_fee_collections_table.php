<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeeCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('billNo',20);
            $table->string('class_id',20);
            $table->string('regi_no',20);
            $table->string('academic_year_id');

            $table->decimal('payableAmount',18,2);
            $table->decimal('paidAmount',18,2);
            $table->decimal('dueAmount',18,2);
            $table->date('payDate');
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
        Schema::dropIfExists('fee_collections');
    }
}
