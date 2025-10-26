<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionModel;
use App\Models\CustomerModel;
use App\Models\TransactionDetailModel;
use App\Models\PaymentModel;
use App\Models\ServicesModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Tampilkan daftar transaksi
     */
    public function index()
    {
        $transactions = TransactionModel::with('customer')->orderBy('id', 'desc')->get();
        $payments = PaymentModel::all();
        return view('admin.transaction.index', compact('transactions'));
    }

    /**
     * Form tambah transaksi baru
     */
    public function create()
    {
        $customers = CustomerModel::all();
        $services = ServicesModel::all();
        return view('admin.transaction.create', compact('customers', 'services'));
    }

    /**
     * Simpan transaksi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'tanggal_masuk' => 'required|date',
            'services' => 'required|array',
            'services.*.service_id' => 'required|exists:services,id',
            'services.*.berat' => 'required|numeric|min:0.1',
        ]);

        DB::beginTransaction();

        try {
            // Generate kode transaksi unik
            $kode_transaksi = 'TRX-' . strtoupper(Str::random(6));

            // Simpan transaksi utama
            $transaction = TransactionModel::create([
                'customer_id' => $request->customer_id,
                'kode_transaksi' => $kode_transaksi,
                'tanggal_masuk' => $request->tanggal_masuk,
                'status' => 'pending',
                'total_harga' => 0, // sementara 0, akan dihitung di bawah
            ]);

            $total = 0;

            // Simpan detail transaksi
            foreach ($request->services as $detail) {
                $service = ServicesModel::find($detail['service_id']);
                $subtotal = $service->harga_per_kg * $detail['berat'];
                $total += $subtotal;

                TransactionDetailModel::create([
                    'transaction_id' => $transaction->id,
                    'service_id' => $service->id,
                    'berat' => $detail['berat'],
                    'subtotal' => $subtotal,
                ]);
            }

            // Update total harga transaksi utama
            $transaction->update(['total_harga' => $total]);

            DB::commit();

            return redirect()->route('admin.transaction.index')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Form edit transaksi
     */
    public function edit($id)
    {
        $transaction = TransactionModel::with('details.service')->findOrFail($id);
        $customers = CustomerModel::all();
        $services = ServicesModel::all();
        return view('admin.transaction.edit', compact('transaction', 'customers', 'services'));
    }

    /**
     * Update data transaksi
     */
    public function update(Request $request, $id)
    {
        $transaction = TransactionModel::findOrFail($id);

        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:pending,proses,selesai,diambil',
            'tanggal_selesai' => 'nullable|date',
        ]);

        $transaction->update([
            'customer_id' => $request->customer_id,
            'status' => $request->status,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('admin.transaction.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Hapus transaksi
     */
    public function destroy($id)
    {
        $transaction = TransactionModel::findOrFail($id);
        $transaction->delete();
        return redirect()->route('admin.transaction.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    /**
     * Detail transaksi
     */
    public function show($id)
    {
        $transaction = TransactionModel::with(['customer', 'details.service'])->findOrFail($id);

        // dd($transaction);
        return view('admin.transaction.show', compact('transaction'));
    }

    public function updateStatusTransaction($id)
{
    $updateDiambil = DB::table('transactions')
        ->where('id', $id)
        ->whereIn('status', ['lunas', 'selesai'])
        ->update(['status' => 'diambil']);

    if ($updateDiambil) {
        return redirect()->route('admin.transaction.index')
            ->with('success', 'Status transaksi berhasil diubah menjadi "diambil".');
    } else {
        return redirect()->route('admin.transaction.index')
            ->with('error', 'Gagal memperbarui status transaksi.');
    }
}

    
}
