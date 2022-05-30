<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locaties';

    protected $fillable = [
        'adres',
        'postcode',
        'aantalplekken',
        'parkeerplaatsnaam',
        'latitude',
        'longitude',
        'ID_parkeerplaats',
    ];
}
