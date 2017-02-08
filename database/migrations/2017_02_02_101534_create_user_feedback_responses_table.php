<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;

class CreateUserFeedbackResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Model::unguard();
        Schema::create('user_feedback_response', function (Blueprint $table) {
            $table->increments('id');
            $table->string("response", 5000);
            $table->string("status");   
            $table->unsignedInteger("user_feedback_id");
            $table->unsignedInteger("responded_user_id");
            $table->index(['user_feedback_id', 'responded_user_id']);
            $table->foreign('responded_user_id')->references('id')->on('users');
            $table->foreign('user_feedback_id')->references('id')->on('user_feedback');
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
        Schema::drop('user_feedback_response');
    }
}
