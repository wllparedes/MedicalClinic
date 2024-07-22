<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Livewire\Features\SupportAttributes\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;     
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;


    protected $fillable = [
        'names',
        'last_names',
        'username',
        'slug',
        'gender',
        'birthday',
        'district',
        'province',
        'address',
        'dni',
        'phone',
        'emergency_phone',
        'email',
        'password',
        'nationality',
        'active',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Properties

    public function getUserTypeAttribute()
    {
        return 'patient';
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->names} {$this->last_names}";
    }

    // Relationships

    public function medicalHistory(): HasOne
    {
        return $this->hasOne(MedicalHistory::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function file(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function avatar()
    {
        return $this->load([
            'file' => fn ($q) => $q->where('category', 'avatars')
        ]);
    }

    // Mutators

    protected function names(): Attribute
    {
        return new Attribute(
            set: fn ($value) => ucwords($value)
        );
    }

    protected function lastNames(): Attribute
    {
        return new Attribute(
            set: fn ($value) => ucwords($value)
        );
    }
}
