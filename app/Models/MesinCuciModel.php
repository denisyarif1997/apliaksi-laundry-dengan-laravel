<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelete;


class MesinCuciModel extends Model
{
    use HasFactory;
    use SoftDelete;

    protected $table = 'ms_mesin_laundry';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'kode_mesin', 'nama_mesin', 'kapasitas_kg','lokasi','status'
    ];
}
