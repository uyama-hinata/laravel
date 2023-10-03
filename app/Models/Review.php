<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
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
        return $this->belongsTo(Product::class);
    }
    // リレーション
    public function user()
    {
        return $this->belongsTo(User::class,'member_id');
    }
}