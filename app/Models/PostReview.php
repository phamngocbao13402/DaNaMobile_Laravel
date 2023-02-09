<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

use App\Models\Post;
use App\Models\User;

class PostReview extends Model
{
    use SoftDeletes;
    protected $table = 'post_reviews';

    protected $fillable = [
         'review', 'status', 'user_id','posts_id'
    ];

    public function posts(){
        return $this->belongsTo(Post::class,'posts_id', 'id');
    }


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function countComment(){
        return DB::table('post_reviews')
        ->join('posts','post.id','=','post_reviews.id')
        ->join('users','users.id','=','post_reviews.user_id')
        ->groupby('posts.id')
        ->count(); 
    }
   
}