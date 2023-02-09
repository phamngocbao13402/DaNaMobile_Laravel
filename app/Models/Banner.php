<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory;
    protected $table = "banner";
    public $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'banner_img',
        'location',
        'deleted_at'
    ];
    use SoftDeletes;
}