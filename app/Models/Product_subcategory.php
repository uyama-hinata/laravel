<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product_subcategory extends Model
{
    use HasFactory,SoftDeletes;
    // テーブル名
    protected $table='product_subcategories';

    // 可変項目
    protected $fillable=
    [
        'name',
    ];
    // リレーション
    public function product_category()
    {
        return $this->belongsTo(Product_category::class);
    }
}
