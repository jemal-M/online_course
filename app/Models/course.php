<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    protected $fillable = [
        'instructor_id',
        'category_id',
        'title',
        'slug',
        'description',
        'price',
        'thumbnail',
        'level',
        'duration',
        'status'
    ];
    public function instructor(){
        $this->belongsTo(User::class,'instructor_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
     public function sections(){
        return $this->hasMany(CourseSection::class);
    }
    public function enorllments(){
        return $this->hasMany(Enrollment::class);
    }
    public function reviews(){
        return $this->belongsTo(Review::class);
    }
}
