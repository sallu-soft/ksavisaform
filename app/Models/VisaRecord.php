<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaRecord extends Model
{
    use HasFactory;

    protected $table = 'visa_record';


    protected $fillable = [
        'id',
        'profession',
        'year',
        'visa_number',
        'sponsor_name',
        'passport_no',
        'sl',
        'is_cancelled',
        'date',
        'user',  // Include user_id
    ];
}
