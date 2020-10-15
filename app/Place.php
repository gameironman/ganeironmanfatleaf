<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $table = 'place'; //若資料庫名稱沒有變成複數或名字無變化則要加上保護

    protected $fillable = [
        'email', 'location', 'file', 'place_name', 'description'
    ];
}
