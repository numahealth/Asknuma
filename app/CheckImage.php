<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class CheckImage extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'checkimage';
    
    protected $fillable = [
          'profile_pic',
          'name'
    ];
    

    public static function boot()
    {
        parent::boot();

        CheckImage::observe(new UserActionsObserver);
    }
    
    
    
    
}