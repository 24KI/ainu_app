<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ainu02Score extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'question1',
        "question2",
        "question3",
        "question4",
        "question5",
        "question6",
        "question7",
        "question8",
        "question9",
        "question10",
        "quiz_success_count",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
