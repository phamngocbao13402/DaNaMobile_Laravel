<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specification extends Model
{
    use HasFactory;

    protected $table = "product_specifications_options";
    public $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'specification_name',
        'deleted_at'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    use SoftDeletes;
}
