<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningTypeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'learning_type_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function learningType()
    {
        return $this->belongsTo(LearningType::class);
    }
}
