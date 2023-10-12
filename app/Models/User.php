<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    
    // テーブル名
    protected $table='users';

    // 可変項目
    protected $fillable=
    [
        'name_sei',
        'name_mei',
        'gender',
        'nickname',
        'password',
        'email',
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class,'member_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'member_id');
    }
}