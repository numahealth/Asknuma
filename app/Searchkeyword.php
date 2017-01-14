<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Searchkeyword extends Model {

    

    

   protected $dates = ['deleted_at'];

    protected $table    = 'searchkeyword';
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];
    protected $fillable = [
          'keyword',
          'description',
		  'status'
    ];
    

    public static function boot()
    {
        parent::boot();

        Searchkeyword::observe(new UserActionsObserver);
    }
    
    
    
    
}