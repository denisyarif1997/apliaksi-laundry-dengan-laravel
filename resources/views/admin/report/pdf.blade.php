<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 5px 0;
            color: #333;
        }
        .info {
            margin-bottom: 20px;
        }
        .info table {
            width: 100%;
        }
        .info td {
            padding: 5px;
        }
        .summary {
            background: #f5f5f5;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .summary table {
            width: 100%;
        }
        .summary td {
            padding: 8px;
            font-weight: bold;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table.data th {
            background: #4a5568;
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 11px;
        }
        table.data td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        table.data tr:nth-child(even) {
            background: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        .total-row {
            background: #e2e8f0 !important;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ config('app.name') }}</h2>
        <h3>LAPORAN PENDAPATAN</h3>
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</p>
    </div>

    <div class="summary">
        <table>
            <tr>
                <td width="50%">Total Transaksi:</td>
                <td width="50%" class="text-right">{{ $totalTransactions }} transaksi</td>
            </tr>
            <tr>
                <td>Total Pendapatan:</td>
                <td class="text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Terbayar:</td>
                <td class="text-right">Rp {{ number_format($totalPaid, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Belum Bayar:</td>
                <td class="text-right">Rp {{ number_format($totalRevenue - $totalPaid, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <table class="data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Kode</th>
                <th width="12%">Tanggal</th>
                <th width="20%">Customer</th>
                <th width="16%" class="text-right">Total</th>
                <th width="16%" class="text-right">Terbayar</th>
                <th width="16%" class="text-right">Sisa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $index => $transaction)
            @php
                $paid = $transaction->payments->sum('jumlah_bayar');
                $remaining = $transaction->total_harga - $paid;
            @endphp
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $transaction->kode_transaksi }}</td>
                <td>{{ \Carbon\Carbon::parse($transaction->tanggal_masuk)->format('d/m/Y') }}</td>
                <td>{{ $transaction->customer->nama ?? 'N/A' }}</td>
                <td class="text-right">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($paid, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($remaining, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4" class="text-right">TOTAL:</td>
                <td class="text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalPaid, 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totalRevenue - $totalPaid, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d F Y H:i:s') }}</p>
        <p>{{ config('app.name') }} - Sistem Manajemen Laundry</p>
    </div>
</body>
</html>
