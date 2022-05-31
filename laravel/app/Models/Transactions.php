<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// Model om transactie gegevens op te slaan die uit de database worden gehaald.
class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transacties';
    public $timestamps = false;

    protected $fillable = [
        'ID_Parkeerplaats',
        'kenteken',
        'begintijd',
        'eindtijd',

    ];
}
