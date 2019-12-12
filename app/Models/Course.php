<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = ['course_code', 'name'];

    public $timestamps = false; 

    public function gains()
    {
    	return $this->hasMany(Gain::class);
    }
}
