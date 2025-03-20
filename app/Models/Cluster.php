<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cluster extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'title',
        'qualification',
        'qs_code',
    ];

    /**
     * A Cluster belongs to one or more Courses
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_cluster');
    }

    /**
     * A Cluster belongs to one or more ClassSessions
     */
    public function class_sessions(): BelongsTo
    {
        return $this->belongsTo(ClassSession::class);
    }

    /**
     * A Cluster has one or more Units
     */
    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class, 'cluster_unit');
    }
}
