<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    Protected $fillable=['name','email','mobile','registeration_date','status'];
}
