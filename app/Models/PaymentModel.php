<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'transaction_id',
        'jumlah_bayar',
        'metode'];

    public function transaction() {
        return $this->belongsTo(TransactionModel::class, 'transaction_id');
    }
}
