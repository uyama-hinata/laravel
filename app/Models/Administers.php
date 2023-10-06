<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Administers extends Authenticatable
{
    use HasFactory;
    
    // テーブル名
    protected $table='administers';

    // 可変項目
    protected $fillable=
    [
        'name',
        'login_id',
        'password',
    ];
    
}
