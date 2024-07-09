<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    // Relationships

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'doctor_specialty', 'specialty_id', 'doctor_id');
    }

}
