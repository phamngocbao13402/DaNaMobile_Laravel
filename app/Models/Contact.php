<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    protected $table ='contact';
    protected $fillable = [
        'contact_id',
        'contact_name',
        'contact_subject',
        'contact_email',
        'contact_message'
    ];
}
