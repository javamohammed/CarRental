<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarMark extends Model
{
    //
    public function models()
    {
        return $this->hasMany(CarModel::class);
    }
}
