<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Boeking extends Model
{
    protected $fillable = [
        'checkin',
        'checkout',
        'volwassenen',
        'kinderen',
        'voornaam',
        'achternaam',
        'email',
        'telefoon',
        'vragen',

        
    ];
}
