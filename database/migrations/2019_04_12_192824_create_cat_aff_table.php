<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatAffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_aff', function (Blueprint $table) {
            $table->bigInteger('categories_id')->unsigned();
            $table->bigInteger('affirmations_id')->unsigned();            
            $table->foreign('categories_id')->references('id')->on('categories');  
            $table->foreign('affirmations_id')->references('id')->on('affirmations');          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_aff');
    }
}
