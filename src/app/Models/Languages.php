<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hours;
use App\Models\Hours_contents;
use App\Models\Hours_languages;
use App\Models\Contents;

class Languages extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'color'];

    // 他のモデルとのリレーションシップを定義できます
    public function hoursContents()
    {
        return $this->hasMany(HoursContent::class);
    }
}
