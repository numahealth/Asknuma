<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class SubCatetory extends Model {

    

    

    protected $table    = 'subcatetory';
    
    protected $fillable = [
          'sub_category_name',
          'category_id',
          'status'
    ];
    
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];


    public static function boot()
    {
        parent::boot();

        SubCatetory::observe(new UserActionsObserver);
    }
    
    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');;
    }


    
    
    
}