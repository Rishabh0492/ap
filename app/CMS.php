<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    Protected $table='cms';
    Protected $fillable=['cms_page_name','cms_page_content','status','created_by'];
}
