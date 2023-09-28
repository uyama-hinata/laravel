<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    use HasFactory;
    // テーブル名
    protected $table='product_categories';

    // 可変項目
    protected $fillable=
    [
        'name',
    ];

    public function product_subcategories()
    {
        return $this->hasMany(Product_subcategory::class);
    }
}
