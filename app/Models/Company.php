<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'telephone', // WhatsApp
        'email',
        'logo',
        'footer_message',
        'maps_url',
        'owner_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
