<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'facility';
    
    protected $fillable = [
          'category_id',
          'subcatetory_id',
          'name',
          'address',
          'latitude',
          'longitude',
          'working_hours',
          'status',
          'contact',
          'open',
          'close',
          'all_time_service','timing','verified'
    ];
    
  public static $status = ["Active" => "Active", "Inactive" => "Inactive"];
   public static $verified= ["1" => "Verified", "0" => "Unverified"];
    public static function boot()
    {
        parent::boot();

        Facility::observe(new UserActionsObserver);
    }
    
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }


    public function subcatetory()
    {
        return $this->hasOne('App\SubCatetory', 'id', 'subcatetory_id');
    }


    
    
    
}