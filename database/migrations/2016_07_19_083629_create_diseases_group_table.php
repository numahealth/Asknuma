<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateDiseasesGroupTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('diseasesgroup',function(Blueprint $table){
            $table->increments("id");
            $table->string("group name");
            $table->string("diseases_name");
            $table->string("symptom");
            $table->enum("Active, Inactive", [""])->nullable();
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
        Schema::drop('diseasesgroup');
    }

}