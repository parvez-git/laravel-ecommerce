<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
    	'order_id',
		'firstname',
		'lastname',
		'email',
		'phone',
		'address',
		'address2',
		'country',
		'state',
		'zip'
    ];
}
