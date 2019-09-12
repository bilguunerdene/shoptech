<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
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
            $table->string('article_number');
            $table->string('barcode');
            $table->float('inprice');
            $table->float('price');
            $table->integer('cnt');
            $table->integer('type')->nullable();;
            $table->integer('countryId')->nullable();;
            $table->text('detail')->nullable();;
            $table->string('imageurl')->nullable();;
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
