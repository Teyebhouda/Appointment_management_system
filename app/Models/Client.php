<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address',
        'postal_code',
        'city',
        'state',
        'country',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    protected $hidden = [
        'password',
    ];
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }


}
