<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\User;


class Preview extends Model
{

    use SoftDeletes;
    protected $table = 'product_reviews';

    protected $fillable = [
        'rate', 'review', 'status', 'user_id','product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id', 'id');
    }


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function countComment(){
        return DB::table('product_reviews')
        ->join('products','products.id','=','product_reviews.id')
        ->join('users','users.id','=','product_reviews.user_id')
        ->groupby('products.id')
        ->count(); 
    }

}
