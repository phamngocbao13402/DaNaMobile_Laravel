<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WishList extends Model
{
    use HasFactory;
    public $table = "wishlists";
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        "image",
        'price',
        'product_id',
        'user_id',
    ];
    use SoftDeletes;
}