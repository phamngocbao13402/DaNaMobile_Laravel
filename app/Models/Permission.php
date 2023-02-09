<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;
    protected $table = 'permission';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name_permission',
    ];
}
