<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'shop_id',
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
        return $this->belongsTo(User::class);
    }
}
