<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voucher extends Model
{
    use HasFactory;
    public $table = "vouchers";
    public $timestamps = true;
    protected $fillable = [
        'id',
        'code',
        'type',
        'value',
        'status',
        'product_id',
    ];
    use SoftDeletes;
    public function voucher_product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function voucher_vu(){
        return $this->hasMany(VoucherUser::class);
    }
}