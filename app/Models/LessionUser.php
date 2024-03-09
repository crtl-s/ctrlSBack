<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessionUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lession_id',
        'score',
        'grade_id',

    ];
    public function lession()
    {
        return $this->belongsTo(Lession::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
