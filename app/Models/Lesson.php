<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'section_id',
        'title',
        'vedio_url',
        'content',
        'duration',
        'order'
    ];
    public function section(){
        return $this->belongsTo(CourseSection::class);
    }
     public function progress(){
        return $this->hasMany(LessonProgress::class);
    }
}
