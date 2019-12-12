<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gain extends Model
{
    protected $table = 'gains';

    protected $fillable = ['name', 'course_id'];

    public $timestamps = false; 

    public function course()
    {
    	return $this->belongsTo(Course::class);
    }
}
