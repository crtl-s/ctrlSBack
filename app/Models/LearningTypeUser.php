<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningTypeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'education_type_id'
    ];

}
