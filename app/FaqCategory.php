<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class FaqCategory extends Model {

    public $timestamps = true;
    protected $table = 'faq_category';
    protected $fillable = [
        'category_name',
        'created_at',
        'updated_at',
        'status'
    ];
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];

    public static function boot() {
        parent::boot();
        FaqCategory::observe(new UserActionsObserver);
    }
    
    public function questions() {
        return $this->hasMany('App\Faq');
    }

}
