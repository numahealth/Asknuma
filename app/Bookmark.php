<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;



class Bookmark extends Model {


    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'numa_bookmark';
    
    protected $fillable = [
          '	user_id',
          'diseases_article_id',
          'status',
          'created_by',
          'updated_by',
          'created_date',
          '	updated_date',
    ];
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];

    public static function boot()
    {
        parent::boot();

        Bookmark::observe(new UserActionsObserver);
    }
    
    public function diseasesarticle()
    {
        return $this->hasOne('App\DiseasesArticle', 'id', 'diseases_article_id');
    }


    
    
    
}