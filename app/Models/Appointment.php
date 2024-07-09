<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'motive',
        'date',
        'start',
        'end',
        'message',
        'type',
        'link',
        'status'
    ];

    // Relationships

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function detail(): HasOne
    {
        return $this->hasOne(AppointmentDetail::class);
    }

    public function diagnosis(): HasOne
    {
        return $this->hasOne(Diagnosis::class);
    }

}
