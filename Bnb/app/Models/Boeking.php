<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boeking extends Model
{
    protected $fillable = [
        'user_id',
        'checkin',
        'checkout',
        'volwassenen',
        'kinderen',
        'bedrag',
        'voornaam',
        'achternaam',
        'email',
        'telefoon',
        'vragen',
    ];

    // Als je tabelnaam niet "boekings" is:
    // protected $table = 'boekingen'; 
}
