<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    use HasFactory,SoftDeletes;
    // テーブル名
    protected $table='product_categories';

    // 可変項目
    protected $fillable=
    [
        'name',
    ];
    // リレーション
    public function product_subcategories()
    {
        return $this->hasMany(Product_subcategory::class,'product_category_id');
    }
}
