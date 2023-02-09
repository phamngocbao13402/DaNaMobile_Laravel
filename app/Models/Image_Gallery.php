<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image_Gallery extends Model
{
    use HasFactory;

    protected $table = 'images_galleries';

    protected $fillable = [
        'small',
        'medium',
        'large',
        'product_id'
    ];
}
