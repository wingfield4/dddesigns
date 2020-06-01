<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    
    public function images()
    {
        return $this->belongsToMany('App\Image', 'review_images');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
