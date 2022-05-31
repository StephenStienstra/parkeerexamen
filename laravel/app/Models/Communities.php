<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communities extends Model
{
    use HasFactory;

    protected $table = 'gemeenten';

    protected $fillable = [
        'ID_gemeente',
        'gemeentenaam',
        'ID_provincie',
    ];
}
