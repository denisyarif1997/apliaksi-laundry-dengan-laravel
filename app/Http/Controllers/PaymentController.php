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
        // Hitung total yang sudah dibayar
        $totalBayar = $transaction->payments()->sum('jumlah_bayar');
        $sisaTagihan = $transaction->total_harga - $totalBayar;

        // Ambil histori pembayaran
        $riwayatPembayaran = $transaction->payments()->latest()->get();

        // Jika sudah lunas, bisa tetap ditampilkan tapi mungkin disable input di view, 
        // atau beri pesan info. Untuk saat ini kita passing datanya saja.
        
        return view('admin.payment.create', compact('transaction', 'totalBayar', 'sisaTagihan', 'riwayatPembayaran'));
    }

    public function store(Request $request, TransactionModel $transaction)
    {
        $totalBayar = $transaction->payments()->sum('jumlah_bayar');
        $maxBayar = $transaction->total_harga - $totalBayar;

        $request->validate([
            'jumlah_bayar' => ['required', 'numeric', 'min:0.1', 
                function ($attribute, $value, $fail) use ($maxBayar) {
                    if ($value > $maxBayar) {
                        $fail("Jumlah bayar tidak boleh melebihi sisa tagihan (Rp " . number_format($maxBayar, 0, ',', '.') . ")");
                    }
                }
            ],
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

            // Hitung ulang total setelah pembayaran masuk
            $newTotalBayar = $transaction->payments()->sum('jumlah_bayar');

            // Update status transaksi
            // Gunakan floating point comparison yang aman atau >=
            if ($newTotalBayar >= $transaction->total_harga) {
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

