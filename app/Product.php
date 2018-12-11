<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'name',
		'slug',
		'price',
		'image',
		'category_id',
		'description'
	];
	
	public function category()
	{
		return $this->belongsTo(Category::class);
	}
}
