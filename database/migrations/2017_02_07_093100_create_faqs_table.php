<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()  
    {
        Model::unguard(); 
        Schema::create('faq', function (Blueprint $table) {
            $table->increments('id');
            $table->string("question");
            $table->string("answer", 5000);
            $table->string("status");
            $table->unsignedInteger("category_id");
            $table->index(['category_id']);
            $table->foreign('category_id')->references('id')->on('faq_category');
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
        Schema::drop('faq');
    }
}
