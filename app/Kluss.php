<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kluss extends Model
{
    //
    protected $fillable = [
            'title', 'description', 'kluss_image', 'price', 'date', 'latitude', 'longitude', 'user_id', 'accepted'
    ];

}
