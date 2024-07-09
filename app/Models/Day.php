<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cod',
        'its_workday'
    ];

    // Relationships

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}
