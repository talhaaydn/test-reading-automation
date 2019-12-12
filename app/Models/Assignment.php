<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'user_course_assign';

    protected $fillable = ['department_id', 'class_id', 'year_term_id', 'course_id', 'user_id'];

    public $timestamps = false; 

    public function department()
    {
    	return $this->belongsTo(Department::class);
    }

    public function class()
    {
    	return $this->belongsTo(Classes::class);
    }

    public function yearTerm()
    {
    	return $this->belongsTo(YearTerm::class);
    }

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
