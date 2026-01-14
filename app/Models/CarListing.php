<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CarListing extends Model
{
    protected $fillable = [
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
        'user_id',
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

        // Only generate slug if it's empty
        if (empty($listing->slug)) {
            $listing->slug = Str::slug($listing->title) . '-' . Str::random(6);
        }

        // If title changed later, regenerate slug (still unique)
        if ($listing->exists && $listing->isDirty('title')) {
            $listing->slug = Str::slug($listing->title) . '-' . Str::random(6);
        }
    });
    }
}
