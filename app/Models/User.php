<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'full_name',
        'school_origin',
        'phone',
        'address',
        'pob',
        'dob',
        'current_school',
        'nisn',
        'is_active',
        'activation_token',
    ];

    public function isProfileComplete(): bool
    {
        return !empty($this->full_name) &&
               !empty($this->school_origin) &&
               !empty($this->address) &&
               !empty($this->pob) &&
               !empty($this->dob) &&
               !empty($this->current_school) &&
               !empty($this->nisn);
    }

    public function testSessions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TestSession::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
