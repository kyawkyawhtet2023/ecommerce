<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    
    protected $table = 'product_item';

    
    protected $fillable = [
        'product_id',
        'name',
        'image',
        'price',
        'quantity',
        'weight',
        'length',
        'height',
        'width',
        'sku',
        'barcode',
        'is_active'
    ];

   
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
