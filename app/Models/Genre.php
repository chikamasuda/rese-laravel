<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    /**
     * shopsテーブルとのリレーション 
     *
     * @return void
     */
    public function shop()
    {
        return $this->hasOne(Shop::class, 'genre_id');
    }
}
