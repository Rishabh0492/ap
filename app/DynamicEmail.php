<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DynamicEmail extends Model
{
    Protected $table='dynamic_emails';
    Protected $fillable=['to','subject','description','status'];
}
