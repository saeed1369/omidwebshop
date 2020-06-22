<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductfiltersTable extends Migration
{
    /**
     * Run the migrations.
     *     * @return void
     */
    public function up()
    {
        Schema::create('productfilters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filterName');
            $table->string('filterValue');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
        Schema::dropIfExists('productfilters');
    }
}
