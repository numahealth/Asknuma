<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateBlogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('blog',function(Blueprint $table){
            $table->increments("id");
            $table->string("blog_name");
            $table->string("meta_title");
            $table->string("meta_description")->nullable();
            $table->string("keyword")->nullable();
            $table->text("description")->nullable();
            $table->string("blog_image")->nullable();
            $table->string("blog_video")->nullable();
            $table->enum("status", ["Active", "Inactive", "Delete"])->nullable();
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
        Schema::drop('blog');
    }

}