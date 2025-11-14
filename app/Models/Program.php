<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';

    protected $primaryKey = 'program_id';

    protected $fillable = [
        'program_Title',
        'program_Code',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Foreign Keys
    public function students()
    {
        return $this->hasMany(Student::class, 'program_id');
    }

    // SCOPES
    public function scopeSearch($query, $term)
    {
        if ($term) {
            $term = "%{$term}%";
            $query->where(function ($q) use ($term) {
                $q->where('program_Title', 'like', $term)
                    ->orWhere('program_Code', 'like', $term);
            });
        }
    }
}
