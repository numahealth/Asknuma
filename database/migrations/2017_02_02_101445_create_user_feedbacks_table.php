<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;

class CreateUserFeedbacksTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     * 
     */
    public function up() {  
        Model::unguard();
        Schema::create('user_feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->string("feedback_type");
            $table->string("feedback_message", 5000);
            $table->string("feedback_given_as");
            $table->string("feedback_purpose");
            $table->string("satisfaction_level");
            $table->string("status");
            $table->unsignedInteger("user_id");
            $table->index(['user_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('user_feedback');
    }

}
