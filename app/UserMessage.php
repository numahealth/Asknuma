<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class UserMessage extends Model {

    

    

    protected $table    = 'usermessage';
    
    protected $fillable = ['message'];
    

    public static function boot()
    {
        parent::boot();

        UserMessage::observe(new UserActionsObserver);
    }
    
    
    
    
}