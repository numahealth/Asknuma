<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class UserFeedback extends Model {

    public $timestamps = true;
    protected $table = 'user_feedback';
    protected $fillable = [
        'feedback_type',
        'feedback_message',
        'feedback__given_as',
        'feedback_purpose',
        'satisfaction_level',
        'created_at',
        'updated_at',
        'status'
    ];
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];

    public static function boot() {
        parent::boot();
        UserFeedback::observe(new UserActionsObserver);
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function responses() {
        return $this->hasMany('App\UserFeedbackResponse');
    }

}
