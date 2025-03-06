<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'package_id',
        'national_code',
        'aqf_level',
        'title',
        'tga_status',
        'status_code',
        'nominal_hours',
    ];

    /**
     * A Course belongs to one package
     */
    public function package(): belongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * A Course has one or more Units
     */
    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class, 'course_unit');
    }

    /**
     * A Course has one or more Clusters
     */
    public function clusters(): BelongsToMany
    {
        return $this->belongsToMany(Cluster::class, 'course_cluster');
    }
}
