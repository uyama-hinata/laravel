<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_subcategory extends Model
{
    use HasFactory;
    // テーブル名
    protected $table='product_subcategories';

    // 可変項目
    protected $fillable=
    [
        'name',
    ];

    public function product_category()
    {
        return $this->belongsTo(Product_category::class);
    }
}
