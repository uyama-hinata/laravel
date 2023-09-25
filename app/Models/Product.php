<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    // テーブル名
    protected $table='products';

    // 可変項目
    protected $fillable=
    [
        'name',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'product_content',
    ];
}
