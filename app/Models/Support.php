<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;
    protected $table = 'supports';
    protected  $fillable = ['created_by','subject','user_assign','attchment','priority','status','description'];
    public  function user_name()
    {
        return  $this->hasOne(User::class,'id','created_by');

    }
}
