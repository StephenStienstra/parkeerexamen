<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class places extends Model
{
    use HasFactory;

    protected $table = 'plaatsen';

    protected $fillable = [
        'ID_plaats',
        'plaatsnaam',
        'ID_gemeente',
    ];
}
