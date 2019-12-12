<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YearTerm extends Model
{
    protected $table = 'year_term';

    protected $fillable = ['year_id', 'term_id'];

    public $timestamps = false;

    public function year () 
    {
        return $this->belongsTo(Year::class);
    }

    public function term () 
    {
        return $this->belongsTo(Term::class);
    }

    public function scopeIsExist($query, $year, $term)
    {
        return $query->where([
            ['year_id', $year],
            ['term_id', $term],
        ])->get()->count();
    }
}
