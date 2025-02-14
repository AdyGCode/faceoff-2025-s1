<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClassSession extends Model
{
    use HasFactory;

    /**
     * ClassSessions have one Cluster
     */
    public function cluster(): HasOne
    {
        return $this->hasOne(Cluster::class);
    }

    /**
     * ClassSessions have one User (Staff)
     */
    public function staff(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * ClassSessions have one or more Users (Students)
     */
    public function students(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
