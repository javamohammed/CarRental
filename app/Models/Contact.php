<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    protected $table = 'contacts';
    protected $fillable = [
        'subject', 'from_name', 'content', 'sender_email', 'receiver_email',  'is_readed' ];
}
