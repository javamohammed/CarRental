<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    protected $table = 'cars';
    protected $guarded = [];
    protected $fillable = [
        'color', 'available', 'description', 'paths_images', 'purchaseDate', 'model_id', 'registration_number', 'number_places', 'type_car', 'number_cylinder'
     ];


    public function model()
    {
        return $this->belongsTo( CarModel::class);
    }
}

