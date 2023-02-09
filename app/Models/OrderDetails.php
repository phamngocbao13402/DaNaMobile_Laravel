<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;

class OrderDetails extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'order_details';
    protected $fillable = [
        'id',
        'quantity',
        'total_amount',
        'order_id',
        'product_id'
    ];

    public function orders(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
    public function products(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}