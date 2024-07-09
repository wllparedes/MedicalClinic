<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Diagnosis extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'diagnosis',
        'prescription',
        'note',
        'need_treatment'
    ];


    // Relationships

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }

    public function treatments(): HasMany
    {
        return $this->hasMany(Treatment::class);
    }
}
