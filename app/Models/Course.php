<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

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
    public function unit(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * A Course has one or more Clusters
     */
    public function cluster(): HasMany
    {
        return $this->hasMany(Cluster::class);
    }
}
