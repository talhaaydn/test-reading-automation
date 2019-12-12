<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $table = 'qualifications';

    protected $fillable = ['name', 'department_id'];

    public $timestamps = false; 

    public function department()
    {
    	return $this->belongsTo(Department::class);
    }
}
