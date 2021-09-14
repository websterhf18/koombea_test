<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    //
    protected $fillable = ['filename', 'status', 'has_header', 'json_data', 's3_url'];
}
