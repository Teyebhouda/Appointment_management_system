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
    protected $table = 'users'; // Spécifie la table associée au modèle
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Ajout du champ role
        'is_active', // Ajout du champ is_active
        'last_login_at', // Ajout du champ last_login_at
        
    ];

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
    public function isAdmin()
{
    return $this->role === 'admin';
}

    public function isActive()
    {
        return $this->is_active;
    }

    public function lastLoginAt()
    {
        return $this->last_login_at;
    }
    public function appointments()
{
    return $this->hasMany(Appointment::class);
}






}
