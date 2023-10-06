<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;
    // テーブル名
    protected $table='reviews';

    // 可変項目
    protected $fillable=
    [
        'evaluation',
        'comment',
    ];
    // リレーション
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    // リレーション
    public function user()
    {
        return $this->belongsTo(User::class,'member_id');
    }
}