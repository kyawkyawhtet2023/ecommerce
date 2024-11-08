<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name',
        'category_id',
        'highlight',  
        'description',
        'weight',
        'length',
        'height',
        'width',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
        'image_6',
        'is_active'
    ];

  
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productItems()
    {
        return $this->hasMany(ProductItem::class);
    }
}
