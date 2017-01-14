<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateFeedbackTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('feedback',function(Blueprint $table){
            $table->increments("id");
            $table->integer("diseasesarticle_id")->references("id")->on("diseasesarticle");
            $table->integer("user_id")->references("id")->on("user");
            $table->enum("feedback", ["Yes", "No"]);
            $table->integer("reason_id")->references("id")->on("reason");
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
        Schema::drop('feedback');
    }

}