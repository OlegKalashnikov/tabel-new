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

            $table->string('name');

            $table->string('jan',10);
            $table->string('feb',10);
            $table->string('mar',10);
            $table->string('apr',10);
            $table->string('may',10);
            $table->string('jun',10);
            $table->string('jul',10);
            $table->string('aug',10);
            $table->string('sep',10);
            $table->string('oct',10);
            $table->string('nov',10);
            $table->string('dec',10);

            $table->string('rate',5);

            $table->unsignedInteger('category_id');
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
