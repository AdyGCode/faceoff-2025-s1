<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
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
    ];

    /**
     * A Package has many Courses
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
