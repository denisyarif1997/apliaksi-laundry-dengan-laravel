<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicesModel extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'nama_layanan', 'harga_per_kg', 'estimasi_waktu'
    ];
}
