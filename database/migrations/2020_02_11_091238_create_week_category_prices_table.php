<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekCategoryPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_category_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('week_category_id')->nullable();
            $table->integer('dishes_count')->nullable();
            $table->integer('person_count')->nullable();
            $table->integer('price')->nullable();
            
            $table->foreign('week_category_id')->references('id')->on('week_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('week_category_prices');
    }
}
