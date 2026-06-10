<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionModel;
use App\Models\PaymentModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display revenue report
     */
    public function index(Request $request)
    {
        // Default date range: current month
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Get transactions within date range
        $transactions = TransactionModel::with('customer', 'payments')
            ->whereBetween('tanggal_masuk', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        // Calculate statistics
        $totalRevenue = $transactions->sum('total_harga');
        $totalTransactions = $transactions->count();
        $totalPaid = PaymentModel::whereIn('transaction_id', $transactions->pluck('id'))
            ->sum('jumlah_bayar');
        $totalUnpaid = $totalRevenue - $totalPaid;

        // Group by status
        $statusBreakdown = $transactions->groupBy('status')->map(function ($group) {
            return [
                'count' => $group->count(),
                'revenue' => $group->sum('total_harga')
            ];
        });

        // Daily revenue for chart
        $dailyRevenue = TransactionModel::select(
                DB::raw('DATE(tanggal_masuk) as date'),
                DB::raw('SUM(total_harga) as revenue'),
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('tanggal_masuk', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('admin.report.index', compact(
            'transactions',
            'totalRevenue',
            'totalTransactions',
            'totalPaid',
            'totalUnpaid',
            'statusBreakdown',
            'dailyRevenue',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Export to PDF
     */
    public function exportPDF(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $transactions = TransactionModel::with('customer', 'payments')
            ->whereBetween('tanggal_masuk', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $totalRevenue = $transactions->sum('total_harga');
        $totalTransactions = $transactions->count();
        $totalPaid = PaymentModel::whereIn('transaction_id', $transactions->pluck('id'))
            ->sum('jumlah_bayar');

        $pdf = PDF::loadView('admin.report.pdf', compact(
            'transactions',
            'totalRevenue',
            'totalTransactions',
            'totalPaid',
            'startDate',
            'endDate'
        ));

        return $pdf->download('laporan-pendapatan-' . $startDate . '-to-' . $endDate . '.pdf');
    }

    /**
     * Export to Excel
     */
    public function exportExcel(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $transactions = TransactionModel::with('customer', 'payments')
            ->whereBetween('tanggal_masuk', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $totalRevenue = $transactions->sum('total_harga');
        $totalPaid = PaymentModel::whereIn('transaction_id', $transactions->pluck('id'))
            ->sum('jumlah_bayar');

        // Create CSV content
        $filename = 'laporan-pendapatan-' . $startDate . '-to-' . $endDate . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($transactions, $totalRevenue, $totalPaid, $startDate, $endDate) {
            $file = fopen('php://output', 'w');
            
            // UTF-8 BOM for Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, ['LAPORAN PENDAPATAN']);
            fputcsv($file, ['Periode: ' . Carbon::parse($startDate)->format('d/m/Y') . ' - ' . Carbon::parse($endDate)->format('d/m/Y')]);
            fputcsv($file, []);
            
            // Summary
            fputcsv($file, ['Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.')]);
            fputcsv($file, ['Total Terbayar', 'Rp ' . number_format($totalPaid, 0, ',', '.')]);
            fputcsv($file, ['Total Belum Bayar', 'Rp ' . number_format($totalRevenue - $totalPaid, 0, ',', '.')]);
            fputcsv($file, []);
            
            // Table header
            fputcsv($file, ['No', 'Kode Transaksi', 'Tanggal', 'Customer', 'Total', 'Terbayar', 'Status']);
            
            // Data
            $no = 1;
            foreach ($transactions as $transaction) {
                $paid = $transaction->payments->sum('jumlah_bayar');
                fputcsv($file, [
                    $no++,
                    $transaction->kode_transaksi,
                    Carbon::parse($transaction->tanggal_masuk)->format('d/m/Y'),
                    $transaction->customer->nama ?? 'N/A',
                    $transaction->total_harga,
                    $paid,
                    ucfirst($transaction->status)
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
