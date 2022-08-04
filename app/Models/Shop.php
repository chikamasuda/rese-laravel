<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'owner_id',
        'area_id',
        'genre_id',
        'name',
        'description',
        'image_url'
    ];

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

    /**
     * reservationsテーブルとのリレーション
     *
     * @return void
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
