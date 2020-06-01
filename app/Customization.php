<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customization extends Model
{
    use SoftDeletes;
    public function customizationType()
    {
        return $this->belongsTo('App\CustomizationType');
    }

    public function options()
    {
        return $this->hasMany('App\Option');
    }
}
