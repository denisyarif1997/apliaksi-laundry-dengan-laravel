<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'nama','no_telp','alamat'
    ];

    public function transaction()
    {
        return $this->hasMany(TransactionModel::class, 'customer_id');
    }
}
