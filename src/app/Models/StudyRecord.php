<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyRecord extends Model
{
    use HasFactory;
    // app/Models/StudyRecord.php

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'study_languages');
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'study_contents');
}
}
