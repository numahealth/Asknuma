<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


//	use Illuminate\Database\Eloquent\SoftDeletes;

class Menus extends Model {

   // use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'menus';
    
    protected $fillable = [
          'symptom_name',
          'symptom_description',
          'status'
    ];
    
    public static $status = ["Active" => "Active", "Inactive" => "Inactive" ];


    public static function boot()
    {
        parent::boot();

        Symptom::observe(new UserActionsObserver);
    }
    
    
    
    
}