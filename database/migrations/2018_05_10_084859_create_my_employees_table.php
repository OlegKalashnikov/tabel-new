<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees');

            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedInteger('position_id');
            $table->foreign('position_id')->references('id')->on('positions');

            $table->string('rate', 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_employees');
    }
}
