<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Hours_contents;
use App\Models\Hours_languages;
use App\Models\Languages;
use App\Models\Contents;

class Hours extends Model
{
    use HasFactory;

    protected $fillable = ['hour', 'date'];

    // 他のモデルとのリレーションシップを定義できます
    public function hoursLanguages()
    {
        return $this->hasMany(HoursLanguage::class);
    }

    public function hoursContents()
    {
        return $this->hasMany(HoursContent::class);
    }

}
