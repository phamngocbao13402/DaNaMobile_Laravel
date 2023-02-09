<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation_Option extends Model
{
    use HasFactory;

    
    protected $table = 'products_variations_options';

    protected $fillable = [
        'variation_name',
        'product_id '
    ];

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function variation_values()
    {
        return $this->hasMany(Variation_Option_Value::class, 'products_variation_id');
    }


    
}
