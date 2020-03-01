<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeekCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('week_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('week_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('is_hit')->nullable();
        
            $table->foreign('week_id')->references('id')->on('weeks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('week_categories');
    }
}
