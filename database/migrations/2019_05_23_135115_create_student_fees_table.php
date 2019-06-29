<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class_id',20);
            $table->string('regi_num',20);
            $table->string('feeid',20);
            $table->string('origin_fee',20);
            $table->string('type',20);
            $table->string('title',100);
            $table->decimal('fee',18,2);
            $table->decimal('Latefee',18,2)->nullable()->default(0);
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
        Schema::dropIfExists('student_fees');
    }
}
