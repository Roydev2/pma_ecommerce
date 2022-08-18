<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=[
        'company_name',
        'short_des',
        'description',
        'photo',
        'address',
        'phone',
        'email',
        'logo',
        'currency',
        'about_breadcrumb',
        'product_breadcrumb',
    ];
}
