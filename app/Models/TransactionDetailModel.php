<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TransactionModel;
use App\Models\ServicesModel;

class TransactionDetailModel extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';
    protected $fillable = [
        'transaction_id',
        'service_id',
        'berat',
        'subtotal',
    ];

    public function transaction()
    {
        return $this->belongsTo(TransactionModel::class, 'transaction_id');
    }

    public function service()
    {
        return $this->belongsTo(ServicesModel::class, 'service_id');
    }
}
