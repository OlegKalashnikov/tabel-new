<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataMedicallStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_medicall_staffs', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');

            $table->unsignedInteger('month');

            $table->unsignedInteger('my_employee_id');
            $table->foreign('my_employee_id')->references('id')->on('my_employees');

            $table->unsignedInteger('clock_rate');
            $table->string('start_day', 5);
            $table->string('end_day', 5);
            $table->string('number_of_hours', 5);
            $table->unsignedInteger('number_of_days');

            $table->date('date_weekday')->nullable();
            $table->string('start_day_weekday')->nullable();
            $table->string('end_day_weekday')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_medicall_staffs');
    }
}
