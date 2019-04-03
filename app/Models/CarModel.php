<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    //
    protected $guarded = [];

    protected $table = "car_models";


    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function mark()
    {
        return $this->belongsTo(CarMark::class);
    }

}
