<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateSubCatetoryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('subcatetory',function(Blueprint $table){
            $table->increments("id");
            $table->string("sub category name");
            $table->integer("category_id")->references("id")->on("category");
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
        Schema::drop('subcatetory');
    }

}