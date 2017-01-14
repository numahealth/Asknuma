<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Configuration extends Model {

    

    

    protected $table    = 'configuration';
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];
   public static $position= ["Header" => "Header","Body"=>"Body" ,"Footer" => "Footer"];
     public static $type= ["Google" => "Google"];
    protected $fillable = [
          'title',
          'type',
          'code','status','position'
    ];
    

    public static function boot()
    {
        parent::boot();

        Configuration::observe(new UserActionsObserver);
    }
    
    public function menus()
    {
        return $this->hasOne('App\Menus', 'id', 'title');
    }


    
    
    
}