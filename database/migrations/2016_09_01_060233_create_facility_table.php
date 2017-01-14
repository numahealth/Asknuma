<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateFacilityTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('facility',function(Blueprint $table){
            $table->increments("id");
            $table->integer("category_id")->references("id")->on("category");
            $table->integer("subcatetory_id")->references("id")->on("subcatetory")->nullable();
            $table->string("name");
            $table->text("address")->nullable();
            $table->string("latitude");
            $table->string("longitude");
            $table->string("working_hours");
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
        Schema::drop('facility');
    }

}