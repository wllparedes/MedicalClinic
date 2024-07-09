<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'allergies',
        'past_illnesses',
        'family_history',
        'surgeries',
        'vaccinations',
        'social_history',
        'medications',
        'blood_type'
    ];

    // Relationships

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
