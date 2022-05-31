<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// Model om transactie gegevens op te slaan die uit de database worden gehaald.
class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transacties';

    protected $fillable = [
        'ID_Parkeerplaats',
        'kenteken',
        'begintijd',
        'eindtijd',
        'ID_Klant',
        'klantnaam',
        'ID_plaats',
        'plaatsnaam',
        'ID_Gemeente',
        'adres',
        'postcode',
        'lattitude',
        'longitude',
        'parkeeplaatsnaam',
        'aantalplekken',
        'ingangsdatum',
        'prijs',
        'gemeentenaam',
        'ID_Provincie',
        'provincienaam',
    ];
}
