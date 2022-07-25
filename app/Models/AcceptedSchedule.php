<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptedSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'product_id', 
        'schedule_id', 
        'schedule_date', 
        'post_user_id'
    ];
}
