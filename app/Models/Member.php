<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    // テーブル名
    protected $table='members';

    // 可変項目
    protected $fillable=
    [
        'name_sei',
        'name_mei',
        'gender',
        'nickname',
        'passsword',
        'email',
    ];
}
