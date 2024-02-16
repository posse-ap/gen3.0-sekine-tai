<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyLanguage extends Model
{
    use HasFactory;
    
    protected $fillable = ['record_id', 'language_id'];

    protected $attributes = [
        'language_id' => null,
    ];
}
