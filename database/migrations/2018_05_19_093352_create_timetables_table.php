<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedInteger('my_employee_id');
            $table->foreign('my_employee_id')->references('id')->on('my_employees');

            $table->string('1', 10);
            $table->string('2', 10);
            $table->string('3', 10);
            $table->string('4', 10);
            $table->string('5', 10);
            $table->string('6', 10);
            $table->string('7', 10);
            $table->string('8', 10);
            $table->string('9', 10);
            $table->string('10', 10);
            $table->string('11', 10);
            $table->string('12', 10);
            $table->string('13', 10);
            $table->string('14', 10);
            $table->string('15', 10);
            $table->string('16', 10);
            $table->string('17', 10);
            $table->string('18', 10);
            $table->string('19', 10);
            $table->string('20', 10);
            $table->string('21', 10);
            $table->string('22', 10);
            $table->string('23', 10);
            $table->string('24', 10);
            $table->string('25', 10);
            $table->string('26', 10);
            $table->string('27', 10);
            $table->string('28', 10);
            $table->string('29', 10)->default(0);
            $table->string('30', 10)->default(0);
            $table->string('31', 10)->default(0);

            $table->string('month', 10);
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
        Schema::dropIfExists('timetables');
    }
}
