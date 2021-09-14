<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    //
    protected $fillable = ['name', 'date_birth', 'phone', 'address', 'credit_card', 'email', 'franchise'];
}
