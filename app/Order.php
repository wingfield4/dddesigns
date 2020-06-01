<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    public static $PENDING_QUOTE = 1;
    public static $ORDER_INITIALIZED = 8;

    public static $inactiveStatusIds = [ 8 ];
    public static $activeStatusIds = [ 1, 2, 3, 4, 5, 6, 7, 9, 10, 11 ];
    public static $closedStatusIds = [ 12, 13 ];
    
    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item', 'order_items');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    public function isActive()
    {
        return in_array($this->id, $activeStatusIds);
    }

    public function isInactive()
    {
        return in_array($this->id, $inactiveStatusIds);
    }

    public function isClosed()
    {
        return in_array($this->id, $closedStatusIds);
    }

    public function totalPrice()
    {
        $price = 0.00;

        foreach($this->orderItems as $orderItem)
        {
            $price += $orderItem->item->price ?? 0;
            foreach($orderItem->customizationResponses as $customizationResponse)
            {
                if(!is_null($customizationResponse->option_id))
                {
                    $price += $customizationResponse->option->price ?? 0;
                }
            }
        }

        return $price;
    }

    public function save(array $options = array())
    {
        if(empty($this->id)) {
            $this->token = bin2hex(random_bytes(32));
        }
        return parent::save($options);
    }
}
