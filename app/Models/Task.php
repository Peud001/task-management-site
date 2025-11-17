<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'name',
        'priority',
        'projectid'
    ];

    public function projects(): BelongsTo{
        return $this->belongsTo(Project::class);
    }
}
