<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovermentAdmin extends Model
{
    use HasFactory;

    protected $table = 'beheerders';

    protected $fillable = [
        'ID_Beheerder',
        'beheerdernaam',
        'ID_Gemeente',
    ];
}
