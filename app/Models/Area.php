<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    /**
     * shopsテーブルとのリレーション 
     *
     * @return void
     */
    public function shop()
    {
        return $this->hasMany(Shop::class);
    }
}
