<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MesinCuciModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'ms_mesin_laundry';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'kode_mesin', 'nama_mesin', 'kapasitas_kg','lokasi','status'
    ];
}
