<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hospital_register extends Model
{
    use HasFactory;
    protected $hidden = [
        'Hospital_password',
    ];
}
