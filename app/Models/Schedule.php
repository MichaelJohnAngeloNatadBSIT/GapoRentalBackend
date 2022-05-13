<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'product_name', 'product_price', 'product_image', 'schedule_date'];
}
