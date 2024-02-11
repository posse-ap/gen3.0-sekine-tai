<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hours;
use App\Models\Hours_contents;
use App\Models\Languages;
use App\Models\Contents;

class Hours_languages extends Model
{
    use HasFactory;

    protected $fillable = ['language_id', 'hour_id'];

    // リレーションシップを定義します
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function hour()
    {
        return $this->belongsTo(Hour::class);
    }
}
