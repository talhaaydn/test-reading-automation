<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $table = 'exam_types';

    protected $fillable = ['name'];

    public $timestamps = false; 
}
