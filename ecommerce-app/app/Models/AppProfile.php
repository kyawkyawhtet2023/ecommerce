<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppProfile extends Model
{
    use HasFactory;

    
    protected $table = 'app_profiles';

   
    protected $fillable = [
        'name',
        'day_image',
        'night_image',
        'background_image',
        'primary',
        'secondary',
        'name_color',
        'title_color',
        'price_color',
        'body_color',
        'email',
        'phone',
        'address',
    ];

}
