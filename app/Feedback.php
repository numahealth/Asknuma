<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Feedback extends Model {

    

    

    protected $table    = 'feedback';
    
    protected $fillable = [
          'diseasesarticle_id',
          'user_id',
          'feedback',
          'reason_id',
          'status'
    ];
    
    public static $feedback = ["Yes" => "Yes", "No" => "No"];
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];


    public static function boot()
    {
        parent::boot();

        Feedback::observe(new UserActionsObserver);
    }
    
    public function diseasesarticle()
    {
        return $this->hasOne('App\DiseasesArticle', 'id', 'diseasesarticle_id');
    }


    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


    public function reason()
    {
        return $this->hasOne('App\Reason', 'id', 'reason_id');
    }


    
    
    
}