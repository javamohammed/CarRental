<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unlocked extends Model
{
    //
    protected $table = 'unlockeds';
    protected $fillable = [
        'email', 'number_attempts', 'register_token' ];
}
