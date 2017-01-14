<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateDiseasesArticleTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('diseasesarticle',function(Blueprint $table){
            $table->increments("id");
            $table->integer("diseases_id")->references("id")->on("diseases");
            $table->string("article_title");
            $table->string("meta_title");
            $table->string("meta_description")->nullable();
            $table->string("keyword")->nullable();
            $table->text("article_description")->nullable();
            $table->string("article_profile")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('diseasesarticle');
    }

}