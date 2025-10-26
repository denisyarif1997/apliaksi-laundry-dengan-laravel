<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionDetailModel;

class TransactionModel extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'kode_transaksi',
        'tanggal_masuk',
        'tanggal_selesai',
        'total_harga',
        'status',  
    ];

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class, 'customer_id');
    }
    public function details()
    {
        return $this->hasMany(TransactionDetailModel::class, 'transaction_id');
    }

    public function payments() {
        return $this->hasMany(PaymentModel::class, 'transaction_id');
    }
}
