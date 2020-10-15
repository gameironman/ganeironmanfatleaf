<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'image', 'product_type_id', 'info', 'price', 'date', 'info_image'
    ];

    public function product_type()
    {
        return $this->belongsTo('App\ProductType');
    }

    public function product_imgs()
    {
        return $this->hasMany('App\ProductImg','product_id');
    }
}
