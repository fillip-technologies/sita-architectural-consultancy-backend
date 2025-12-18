<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $fillable = ['first_name','last_name','email','phone','project_type','project_description'];
}
