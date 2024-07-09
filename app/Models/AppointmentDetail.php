<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AppointmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'height',
        'weight',
        'blood_pressure',
        'heart_rate',
        'temperature',
        'symptoms',
        'bmi',
    ];

    // Relationships

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
