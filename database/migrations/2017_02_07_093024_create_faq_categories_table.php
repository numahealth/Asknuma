<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;

class CreateFaqCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */  
    public function up()
    {
        Model::unguard();
        Schema::create('faq_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string("category_name");  
            $table->string("status");
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
        Schema::drop('faq_category');
    }
}
