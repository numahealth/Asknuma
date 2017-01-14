<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Pages extends Model {

    

    

    protected $table    = 'pages';
    
    protected $fillable = [
          'page_title',
          'meta_title',
          'meta_description',
          'keyword',
          'description',
          'status'
    ];
    
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];


    public static function boot()
    {
        parent::boot();

        Pages::observe(new UserActionsObserver);
    }
    
    
    
    
}