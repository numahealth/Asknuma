<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;



class Blog extends Model {
        

    protected $table    = 'blog';
    
    protected $fillable = [
          'blog_name',
          'meta_title',
          'meta_description',
          'keyword',
          'description',
          'blog_image',
          'blog_video',
          'status',
          'disclaimer',
          'references'
    ];
    
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];


    public static function boot()
    {
        parent::boot();

        Blog::observe(new UserActionsObserver);
    }
    
    
    
    
}