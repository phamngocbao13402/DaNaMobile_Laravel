<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class VoucherUser extends Model
{
    use HasFactory;
    public $table = "voucher_user";
    public $timestamps = true;
    protected $fillable = [
        'id',
        'user_id',
        'voucher_id'
    ];
    use SoftDeletes;
    public function vu_voucher()
    {
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }

    public function vu_user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
