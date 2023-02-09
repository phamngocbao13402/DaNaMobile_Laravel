<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    protected $table = "slider";
    public $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'slider_img',
        'deleted_at'
    ];
    use SoftDeletes;
}