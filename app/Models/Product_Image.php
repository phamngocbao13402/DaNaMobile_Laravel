<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Image extends Model
{
    use HasFactory;

    protected $table = 'product_images';

    protected $fillable = [
        'image_gallery_id',
        'products_variation_value_id',
    ];
}
