<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class UserFeedbackResponse extends Model
{
    protected $timestamps = true;
    protected $table = 'user_feedback_response';
    protected $fillable = [
        'response',
        'responded_user_id',
        'user_feedback_id',
        'status'
    ];
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];

    public static function boot() {
        parent::boot();
        UserFeedbackResponse::observe(new UserActionsObserver);
    }
    
    public function respondedUser()
    {
        return $this->belongsTo('App\User');
    }
    
    public function feedback()
    {
        return $this->belongsTo('App\UserFeedback');
    }
    
}
