<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class History extends Model {

    

    

    protected $table    = 'numa_search_history';
    
    protected $fillable = ['history'];
    

    public static function boot()
    {
        parent::boot();

        History::observe(new UserActionsObserver);
    }
    
     public function user_name()
    {
        return $this->hasOne('App\User', 'id','user_id');
    }
    
    
}