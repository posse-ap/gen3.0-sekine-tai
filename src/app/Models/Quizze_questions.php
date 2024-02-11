<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quizze_questions extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'image',
        'text',
        'supplement',
        'quiz_id'
    ];

    public function questions(){
        return $this->belongsTo(Quizze::class,'quiz_id');
    }

    public function choices(){
        return $this->hasMany(Quizze_choices::class,'question_id','id');
    }
}
