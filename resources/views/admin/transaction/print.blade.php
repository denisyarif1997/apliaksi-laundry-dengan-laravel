<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $transaction->kode_transaksi }}</title>
    <style>
        @page {
            size: 100mm auto; /* Lebar 10cm, tinggi otomatis */
            margin: 0;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            width: 100mm;
            padding: 5mm;
            margin: 0;
            font-size: 12px;
            color: #000;
            background: #fff;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }
        .mb-1 { margin-bottom: 4px; }
        .mb-2 { margin-bottom: 8px; }
        .border-bottom { border-bottom: 1px dashed #000; padding-bottom: 5px; margin-bottom: 5px; }
        .border-top { border-top: 1px dashed #000; padding-top: 5px; margin-top: 5px; }
        .table { width: 100%; border-collapse: collapse; }
        .table td { vertical-align: top; }
        .img-logo { max-width: 60px; max-height: 60px; margin-bottom: 5px; }
        
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    
    <div class="text-center mb-2">
        @if($company && $company->logo)
            @if(\Illuminate\Support\Str::startsWith($company->logo, 'data:image'))
                <img src="{{ $company->logo }}" alt="Logo" class="img-logo">
            @else
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" class="img-logo">
            @endif
        @endif
        <h2 class="mb-1" style="margin-top: 0;">{{ $company->name ?? 'LaraLaundry' }}</h2>
        <div style="font-size: 10px;">{{ $company->address ?? 'Alamat belum diatur' }}</div>
        <div style="font-size: 10px;">WA: {{ $company->telephone ?? '-' }}</div>
    </div>

    <div class="border-bottom"></div>

    <table class="table" style="font-size: 11px;">
        <tr>
            <td width="35%">No. Transaksi</td>
            <td width="5%">:</td>
            <td class="fw-bold">{{ $transaction->kode_transaksi }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Pelanggan</td>
            <td>:</td>
            <td>{{ $transaction->customer->nama }}</td>
        </tr>
    </table>

    <div class="border-bottom"></div>

    <table class="table" style="font-size: 11px;">
        @foreach($transaction->details as $detail)
        <tr>
            <td colspan="3" class="fw-bold">{{ $detail->service->nama_paket }}</td>
        </tr>
        <tr>
            <td>{{ $detail->berat }} Kg x Rp {{ number_format($detail->service->harga_per_kg, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="border-top"></div>

    <table class="table" style="font-size: 12px;">
        <tr>
            <td class="fw-bold">Total Tagihan</td>
            <td class="text-right fw-bold">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Bayar</td>
            <td class="text-right">Rp {{ number_format($transaction->payments->sum('jumlah_bayar'), 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Sisa Pembayaran</td>
            <td class="text-right">Rp {{ number_format($transaction->total_harga - $transaction->payments->sum('jumlah_bayar'), 0, ',', '.') }}</td>
        </tr>
        @if($transaction->status == 'lunas')
        <tr>
            <td colspan="2" class="text-center fw-bold" style="padding-top: 5px;">* LUNAS *</td>
        </tr>
        @endif
    </table>

    <div class="border-top mb-2"></div>

    <div class="text-center" style="font-size: 10px;">
        {{ $company->footer_message ?? 'Terimakasih atas kepercayaan Anda.' }}
    </div>

</body>
</html>
