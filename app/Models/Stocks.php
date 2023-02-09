<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stocks extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'total_stock', 'unit_price', 'total_price', 'products_combinations_id','created_at','updated_at'
    ];

    protected $table = 'products_stocks';
    public function combination(){
        return $this->belongsTo(Combinations::class,'products_combinations_id');
    }
    
    public function combinations(){
        return $this->haMany(Combinations::class,'products_combinations_id', 'id');
    }
}
