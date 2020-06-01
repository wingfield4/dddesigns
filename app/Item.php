<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    
    public function customizations()
    {
        return $this->hasMany('App\Customization');
    }

    // public function validCustomizations()
    // {
    //     return $this->customizations->where('deleted_at', null);
    // }

    public function images()
    {
        return $this->belongsToMany('App\Image', 'item_images');
    }

    public function thumbnailImage()
    {
        return $this->belongsTo('App\Image');
    }

    public function information()
    {
        return $this->hasMany('App\ItemInformation');
    }

    public function itemType()
    {
        return $this->belongsTo('App\ItemType');
    }
}
