<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Test extends Model {

    

    

    protected $table    = 'test';
    
    protected $fillable = ['excel'];
    

    public static function boot()
    {
        parent::boot();

        Test::observe(new UserActionsObserver);
    }
    
    
    
    
}