<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $table ="task";
    protected $fillable = [
        'task_name',
        'task_description',
        'board_id',
        'user_id'
    ];
}
