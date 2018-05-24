<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('january',10);
            $table->string('february',10);
            $table->string('march',10);
            $table->string('april',10);
            $table->string('may',10);
            $table->string('june',10);
            $table->string('july',10);
            $table->string('august',10);
            $table->string('september',10);
            $table->string('october',10);
            $table->string('november',10);
            $table->string('december',10);
            $table->string('year',10);

            $table->unsignedInteger('rate');

            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');

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
        Schema::dropIfExists('standards');
    }
}
