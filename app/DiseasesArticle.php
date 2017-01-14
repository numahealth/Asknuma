<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;



class DiseasesArticle extends Model {


    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'diseasesarticle';
    
    protected $fillable = [
          'diseases_id',
          'article_title',
          'meta_title',
          'meta_description',
          'keyword',
          'article_description',
          'article_profile',
		  'status',
		  'article_video',
		  'disclaimer',
          'references'
    ];
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];

    public static function boot()
    {
        parent::boot();

        DiseasesArticle::observe(new UserActionsObserver);
    }
    
    public function diseases()
    {
        return $this->hasOne('App\Diseases', 'id', 'diseases_id');
    }


    
    
    
}