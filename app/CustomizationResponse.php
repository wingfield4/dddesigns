<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomizationResponse extends Model
{
    use SoftDeletes;
    
    public function customization()
    {
        return $this->belongsTo('App\Customization');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function option()
    {
        return $this->belongsTo('App\Option');
    }
}
