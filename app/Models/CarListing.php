<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CarListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_model_id',
        'make',
        'model',
        'title',
        'slug',
        'year',
        'mileage',
        'fuel_type',
        'transmission',
        'price',
        'location',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carModel()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    protected static function booted()
    {
        static::saving(function ($listing) {

            if (empty($listing->slug) || ($listing->exists && $listing->isDirty('title'))) {
                $listing->slug = Str::slug($listing->title) . '-' . Str::random(6);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
