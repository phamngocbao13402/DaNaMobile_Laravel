<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
   protected $table = 'categories';

   protected $fillable = [
      'category_name',
      'category_image',
   ];
   use SoftDeletes;

   public function products()
   {
      return $this->hasMany(Product::class, 'category_id');
   }

   public function product_combis()
   {
       return $this->hasManyThrough(
           Combinations::class,
           Product::class,
           'category_id', 
           'product_id',
           'id', 
           'id' 
       );
   }
}