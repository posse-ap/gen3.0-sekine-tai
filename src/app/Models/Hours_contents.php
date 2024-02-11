<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hours;
use App\Models\Hours_languages;
use App\Models\Languages;
use App\Models\Contents;

class Hours_contents extends Model
{
    use HasFactory;

    protected $fillable = ['content_id', 'hour_id'];

    // リレーションシップを定義します
    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function hour()
    {
        return $this->belongsTo(Hour::class);
    }
}
