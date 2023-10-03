<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
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
        return $this->hasMany(Review::class);
    }
}