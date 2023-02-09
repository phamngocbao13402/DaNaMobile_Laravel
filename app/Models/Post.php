<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
         'title' ,
         'summary',
         'content',
         'post_img',
         'status',
         'category_id',
         'added_by',
    ];
    use SoftDeletes;

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'added_by', 'id');
    }
}
