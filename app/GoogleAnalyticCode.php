<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class GoogleAnalyticCode extends Model {

    

    

    protected $table    = 'googleanalyticcode';
    
    protected $fillable = [
          'code',
          'status'
    ];
    
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];


    public static function boot()
    {
        parent::boot();

        GoogleAnalyticCode::observe(new UserActionsObserver);
    }
    
    
    
    
}