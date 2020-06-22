<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiltervaluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filtervalues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('filter_id')->unsigned();
            $table->foreign('filter_id')->references('id')->on('filters')->onDelete('cascade');
            $table->string('value');

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
        Schema::dropIfExists('filtervalues');
    }
}
