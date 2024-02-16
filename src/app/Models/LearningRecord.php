<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LearningRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'learning_date', 'learning_time'];

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'learning_record_contents');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'learning_record_languages');
    }
}
