<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentModel;
use App\Models\TransactionModel;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function create(TransactionModel $transaction)
    {
        $payment = $transaction->payments()->first();

        if ($payment) 
            {
            return redirect()->route('admin.payment.edit', $payment->id);   
            }

        return view('admin.payment.create', compact('transaction'));
    }

    public function store(Request $request, TransactionModel $transaction)
{
    $request->validate([
        'jumlah_bayar' => 'required|numeric|min:0.1',
        'metode' => 'required|string|max:50',
    ]);

    DB::beginTransaction();
    try {
        // Simpan pembayaran baru
        PaymentModel::create([
            'transaction_id' => $transaction->id,
            'jumlah_bayar' => $request->jumlah_bayar,
            'metode' => $request->metode,
        ]);

        // Hitung total semua pembayaran untuk transaksi ini
        $totalBayar = $transaction->payments()->sum('jumlah_bayar');

        // Update status transaksi: lunas jika sudah membayar penuh
        if ($totalBayar >= $transaction->total_harga) {
            $transaction->update(['status' => 'lunas']);
        } else {
            $transaction->update(['status' => 'proses']);
        }

        DB::commit();

        return redirect()->route('admin.transaction.index')->with('success','Pembayaran berhasil disimpan!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal menyimpan pembayaran: '.$e->getMessage());
    }
    }

    public function update(Request $request, PaymentModel $payment)
    {
    $request->validate([
        'jumlah_bayar' => 'required|numeric|min:0.1',
        'metode' => 'required|string|max:50',
    ]);
    DB::beginTransaction();
    try {
        $payment->update([
            'jumlah_bayar' => $request->jumlah_bayar,
            'metode' => $request->metode,
        ]);

        // Hitung total semua pembayaran untuk transaksi ini
        $totalBayar = $payment->transaction->payments()->sum('jumlah_bayar');

        // Update status transaksi: lunas jika sudah membayar penuh
        if ($totalBayar >= $payment->transaction->total_harga) {
            $payment->transaction->update(['status' => 'lunas']);
        } else {
            $payment->transaction->update(['status' => 'proses']);
        }

        DB::commit();

        return redirect()->route('admin.transaction.index')->with('success','Pembayaran berhasil diupdate!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal mengupdate pembayaran: '.$e->getMessage());
    }
}

    public function edit(PaymentModel $payment)
{
    return view('admin.payment.edit', compact('payment'));
}

}

