<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Reason extends Model {

    

    

    protected $table    = 'reason';
    
    protected $fillable = [
          'reason',
          'status',
          'type'
    ];
    
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];
    public static $type= ["Yes" => "Yes", "No" => "No"];



    public static function boot()
    {
        parent::boot();

        Reason::observe(new UserActionsObserver);
    }
    
    
    
    
}