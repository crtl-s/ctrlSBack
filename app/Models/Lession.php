<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lession extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'topic_id'
    ];
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }


}
