<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_unit');
    }

    /**
     * Units belongs to one or more Cluster
     */
    public function clusters(): BelongsToMany
    {
        return $this->belongsToMany(Cluster::class, 'cluster_unit');
    }
}
