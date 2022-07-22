<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'date',
        'number',
    ];

    /**
     * shopsテーブルとのリレーション 
     *
     * @return void
     */
    public function shops()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    /**
     * usersテーブルとのリレーション 
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
