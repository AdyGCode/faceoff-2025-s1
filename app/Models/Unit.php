<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'national_code',
        'title',
        'tga_status',
        'status_code',
        'nominal_hours',
    ];

    /**
     * Units have one or more Courses
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Units belongs to one or more Cluster
     */
    public function cluster(): BelongsTo
    {
        return $this->belongsTo(Cluster::class);
    }
}
