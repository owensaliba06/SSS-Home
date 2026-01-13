<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'car_models';
    protected $fillable = ['make_id', 'name'];

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function listings()
    {
        return $this->hasMany(CarListing::class, 'car_model_id');
    }
}
