<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comment';
    protected $fillable = [
        'id',
        'product_id',
        'user_id',
        'content',
        'rate',
        'status'
    ];

    public function product() {
        return $this->belongsTo(Product::class,'product_id', 'id');
    }

    public function usre() {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
