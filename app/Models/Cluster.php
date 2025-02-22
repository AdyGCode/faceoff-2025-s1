<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cluster extends Model
{
    use HasFactory;

    /**
     * A Cluster belongs to one or more Courses
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
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
    public function unit(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}
