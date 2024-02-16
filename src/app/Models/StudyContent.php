<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyContent extends Model
{
    use HasFactory;

    protected $fillable = ['record_id', 'content_id'];

    protected $attributes = [
        'content_id' => null,
    ];
}
