<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'area_id');
    }

    public function genre()
    {
        return $this->hasOne(Genre::class, 'id', 'genre_id');
    }
}
