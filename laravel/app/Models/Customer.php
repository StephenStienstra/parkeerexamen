<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'klanten';

    protected $fillable = [
        'ID_Klant',
        'klantnaam',
        'ID_plaats',
    ];
}
