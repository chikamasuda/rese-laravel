<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    /**
     * areasテーブルとのリレーション 
     *
     * @return void
     */
    public function area()
    {
        return $this->hasOne(Area::class, 'id', 'area_id');
    }

    /**
     * genresテーブルとのリレーション 
     *
     * @return void
     */
    public function genre()
    {
        return $this->hasOne(Genre::class, 'id', 'genre_id');
    }

    /**
     * favoritesテーブルとのリレーション 
     *
     * @return void
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * favoritesテーブルとのリレーション 
     *
     * @return void
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
