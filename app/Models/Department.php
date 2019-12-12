<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = ['name', 'faculty_id'];

    public $timestamps = false; 

    public function faculty()
    {
    	return $this->belongsTo(Faculty::class);
    }

    public function qualifications()
    {
    	return $this->hasMany(Qualification::class);
    }
}
