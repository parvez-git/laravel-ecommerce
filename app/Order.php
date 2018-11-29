<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'order_id',
    	'shipping_id',
    	'payment_type',
    	'payment_status',
    	'payment_key',
    	'order_details',
    	'customer_id'
    ];
}
