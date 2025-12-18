<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetPrice extends Model
{
    protected $table = 'setprices';
    protected $primaryKey = 'id';
    protected $fillable = ['general_price','premium_price'];

    
}
