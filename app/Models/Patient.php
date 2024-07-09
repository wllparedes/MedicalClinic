<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'names',
        'last_names',
        'username',
        'slug',
        'gender',
        'birthday',
        'address',
        'dni',
        'phone',
        'emergency_phone',
        'email',
        'password',
        'nationality',
        'active'
    ];

    // Relationships

    public function medicalHistory(): HasOne
    {
        return $this->hasOne(MedicalHistory::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
