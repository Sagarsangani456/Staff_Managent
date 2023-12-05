<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Razorpay extends Model
{
    use HasFactory;

    protected $table = 'payment';
    protected $fillable = ['name','price','payment_type','payment_id','order_id','created_by','user_id','transation_id'];
}
