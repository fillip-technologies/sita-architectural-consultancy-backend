<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $table = 'estimates';
    protected $primaryKey = 'id';
    protected $fillable = ['personal_information','property_information','general_enquiry','premium_enquiry'];

    protected $casts = [
        'personal_information'=>"array",
        'general_enquiry'=>"array",
        'premium_enquiry'=>"array"
    ];
}
