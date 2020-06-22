<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image');
            $table->float('price');
            $table->float('takhfif');
            $table->string('country');
            $table->string('catagory1');
            $table->string('catagory2');
            $table->string('catagory3');
            $table->string('company');
            $table->text('khasiyat');
            $table->longText('aboutProduct');
            $table->string('brand');
            $table->string('hajm');
            $table->text('tarkibat');
            $table->longText('nahvehEstefadeh');
            $table->integer('age');
            $table->string('gener');
            $table->string('codeBehdasht');
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
        Schema::dropIfExists('products');
    }
}
