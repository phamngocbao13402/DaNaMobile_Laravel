<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation_Option_Value extends Model
{
    use HasFactory;

    protected $table = 'products_variations_options_value';

    protected $fillable = [
        'variation_name',
        'variation_value',
        'products_variation_id'
    ];

    
}
