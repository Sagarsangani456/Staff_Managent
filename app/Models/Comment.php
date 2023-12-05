<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['created_by','support_id','comment'];

    public  function user_name()
    {
        return  $this->hasOne(User::class,'id','created_by');

    }
}
