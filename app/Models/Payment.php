<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payments";
    public $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'payment_name',
        'payment_status',
        'deleted_at'
    ];
    use SoftDeletes;
}
