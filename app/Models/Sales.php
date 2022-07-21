<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = ['schedule_id','user_id', 'product_id', 'product_name', 'product_price', 'product_image', 'post_user_id'];
}
