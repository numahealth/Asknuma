<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Group extends Model {

    

    

    protected $table    = 'group';
    
    protected $fillable = [
          'name',
          'dieases',
          'symptom',
		  'status'
    ];
    
	public static $status = ["Active" => "Active", "Inactive" => "Inactive"];
    public static function boot()
    {
        parent::boot();

        Group::observe(new UserActionsObserver);
    }
    
    
    
    
}