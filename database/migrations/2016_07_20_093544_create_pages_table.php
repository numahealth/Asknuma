<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreatePagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('pages',function(Blueprint $table){
            $table->increments("id");
            $table->string("page_title");
            $table->string("meta_title");
            $table->string("meta_description")->nullable();
            $table->string("keyword")->nullable();
            $table->text("description")->nullable();
            $table->enum("status", ["Active", "Inactive"])->nullable();
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
        Schema::drop('pages');
    }

}