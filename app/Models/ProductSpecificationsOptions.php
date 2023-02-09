<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProductSpecificationsOptions extends Model
{
    use HasFactory;
    protected $table = 'product_specifications_options';

    protected $fillable = [
        'specification_name',
        'category_id',
    ];

    public function category() {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }

}
