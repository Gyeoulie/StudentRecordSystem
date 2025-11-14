<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_Fname',
        'student_Mname',
        'student_Lname',
        'student_Email',
        'student_Birthdate',
        'student_Gender',
        'student_Number',
        'student_YearLevel',
        'student_Status',
        'student_Notes',
        'student_Image',
        'program_id',
    ];

    protected $casts = [
        'student_Birthdate' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Foreign
    public function programs()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    // ATTRIBUTES
    protected $appends = ['student_FullName'];

    public function getStudentGenderAttribute($value)
    {
        return $value == 1 ? 'Male' : 'Female';
    }

    public function getStudentFullNameAttribute()
    {
        // Concatenate the first, middle (if present), and last names.
        // The trim() ensures there are no extra spaces if a middle name is missing.
        $fullName = $this->student_Fname . ' ' . $this->student_Mname . ' ' . $this->student_Lname;

        return trim($fullName);
    }

    // SCOPES
    public function scopeSearch($query, $term)
    {
        if ($term) {
            $term = "%{$term}%";
            $query->where(function ($q) use ($term) {
                $q->where('student_Fname', 'like', $term)
                    ->orWhere('student_Mname', 'like', $term)
                    ->orWhere('student_Lname', 'like', $term)
                    ->orWhere('student_Email', 'like', $term)
                    ->orWhere('student_Number', 'like', $term);
            });
        }
    }

    public function scopePrograms($query, $programIds)
    {
        if (!empty($programIds)) {
            $query->whereIn('program_id', $programIds);
        }

        return $query;
    }

    public function scopeYears($query, $years)
    {
        if (!empty($years)) {
            $query->whereIn('student_YearLevel', $years);
        }

        return $query;
    }

    public function scopeStatuses($query, $statuses)
    {
        if (!empty($statuses)) {
            $query->whereIn('student_Status', $statuses);
        }

        return $query;
    }

}
