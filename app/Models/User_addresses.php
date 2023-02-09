<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_addresses extends Model
{
    use HasFactory;
    protected $table = 'user_addresses';

    protected $fillable = [
         'completeAddress' ,
         'phoneNumber',
         'user_id',
    ];
    use SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
