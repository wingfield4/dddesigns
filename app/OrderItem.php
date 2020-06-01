<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;
    
    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function customizationResponses()
    {
        return $this->hasMany('App\CustomizationResponse');
    }
}
