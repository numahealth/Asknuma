<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

class Faq extends Model
{
    
    public $timestamps = true;
    protected $table = 'faq';
    protected $fillable = [
        'question',
        'answer',
        'created_at',
        'updated_at',
        'status'
    ];
    public static $status = ["Active" => "Active", "Inactive" => "Inactive"];

    public static function boot() {
        parent::boot();
        Faq::observe(new UserActionsObserver);
    }
    
    public function category() {
        return $this->belongsTo('App\FaqCategory');
    }

}
