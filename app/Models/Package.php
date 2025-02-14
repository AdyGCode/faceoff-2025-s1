<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    /**
     * A Package has many Courses
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
