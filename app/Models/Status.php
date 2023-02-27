<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'extend_app_enable',
        "ainu01_total_quiz_point",
        "ainu01_practice_count",
        "ainu01_study_count",
        "ainu01_cognomen",
        "ainu02_total_quiz_point",
        "ainu02_practice_count",
        "ainu02_study_count"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
