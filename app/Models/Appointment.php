<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'title',
        'description',
        'appointment_time',
        'status',
        'completed_at',
        'cancelled_at',
        'confirmed_at',
        'pending_at',
    ];

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec Service
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Tu peux ajouter des scopes utiles si tu veux, par exemple :
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}
