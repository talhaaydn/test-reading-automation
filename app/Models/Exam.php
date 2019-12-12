<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = ['file', 'user_course_assign_id', 'exam_type_id'];

    public $timestamps = false; 

    public function assignment()
    {
    	return $this->belongsTo('App\Models\Assignment', 'user_course_assign_id');
    }

    public function examType()
    {
    	return $this->belongsTo('App\Models\ExamType', 'exam_type_id');
    }
}
