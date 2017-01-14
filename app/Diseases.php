<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


//use Illuminate\Database\Eloquent\SoftDeletes;

class Diseases extends Model {

    //use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'diseases';
    
    protected $fillable = [
          'disease_name',
          'description',
          'status'
    ];
    
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];


    public static function boot()
    {
        parent::boot();

        Diseases::observe(new UserActionsObserver);
    }
    
    
    
    
}