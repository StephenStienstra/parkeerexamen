<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingPrices extends Model
{
    use HasFactory;

    protected $table = 'parkeerprijzen';

    protected $fillable = [
        'ID_parkeeplaats',
        'ingangsdatum',
        'prijs',
    ];
}
