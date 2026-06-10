<x-admin>
    @section('title', 'Laporan Pendapatan')

    @push('styles')
    <style>
        /* 🎨 Modern Report Design 2025 */
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            --info-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        }

        .page-header {
            background: white;
            border-radius: 24px;
            padding: 32px;
            margin-bottom: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #f3f4f6;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: #1f2937;
            margin: 0 0 8px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-header .header-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-header .header-icon i {
            color: white;
            font-size: 22px;
        }

        .page-header p {
            color: #6b7280;
            margin: 0;
            font-size: 1rem;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 32px;
            border: 1px solid #f3f4f6;
        }

        .filter-section h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .filter-section .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.875rem;
        }

        .filter-section .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 12px 16px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .filter-section .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .filter-section .btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .filter-section .btn-primary {
            background: var(--primary-gradient);
            border: none;
        }

        .filter-section .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        }

        /* Stats Cards */
        .revenue-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--card-gradient);
            border-radius: 20px;
            padding: 28px 24px;
            color: white;
            box-shadow: 0 10px 40px -10px var(--shadow-color);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(40%, -40%);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px -10px var(--shadow-color);
        }

        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }

        .stat-card .stat-icon i {
            font-size: 24px;
            color: white;
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 8px;
            line-height: 1;
            letter-spacing: -1px;
        }

        .stat-card p {
            font-size: 0.875rem;
            font-weight: 600;
            opacity: 0.95;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card.purple { --card-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); --shadow-color: rgba(99, 102, 241, 0.3); }
        .stat-card.pink { --card-gradient: linear-gradient(135deg, #ec4899 0%, #db2777 100%); --shadow-color: rgba(236, 72, 153, 0.3); }
        .stat-card.cyan { --card-gradient: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); --shadow-color: rgba(6, 182, 212, 0.3); }
        .stat-card.orange { --card-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); --shadow-color: rgba(245, 158, 11, 0.3); }

        /* Chart Container */
        .chart-wrapper {
            background: white;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 32px;
            border: 1px solid #f3f4f6;
        }

        .chart-wrapper h4 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chart-wrapper .chart-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chart-wrapper .chart-icon i {
            color: white;
            font-size: 18px;
        }

        /* Export Buttons */
        .export-section {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .export-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
            border: none;
        }

        .export-btn.pdf {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .export-btn.excel {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .export-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            color: white;
        }

        /* Table Section */
        .table-wrapper {
            background: white;
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #f3f4f6;
        }

        .table-wrapper h4 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .modern-table thead th {
            background: #f9fafb;
            color: #6b7280;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 16px 20px;
            border-bottom: 2px solid #e5e7eb;
            text-align: left;
            white-space: nowrap;
        }

        .modern-table thead th:first-child {
            border-radius: 12px 0 0 0;
        }

        .modern-table thead th:last-child {
            border-radius: 0 12px 0 0;
        }

        .modern-table tbody tr {
            transition: all 0.2s;
        }

        .modern-table tbody tr:hover {
            background: #f9fafb;
        }

        .modern-table tbody td {
            padding: 18px 20px;
            color: #1f2937;
            font-weight: 500;
            border-bottom: 1px solid #f3f4f6;
        }

        .modern-table tfoot tr {
            background: #f9fafb;
            font-weight: 700;
        }

        .modern-table tfoot th {
            padding: 20px;
            color: #1f2937;
            border-top: 2px solid #e5e7eb;
        }

        .transaction-code {
            font-weight: 700;
            color: #6366f1;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
        }

        .amount-paid {
            color: #10b981;
            font-weight: 700;
        }

        .amount-unpaid {
            color: #ef4444;
            font-weight: 700;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 16px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge i {
            font-size: 8px;
        }

        .status-badge.pending { background: #fef3c7; color: #92400e; }
        .status-badge.proses { background: #dbeafe; color: #1e40af; }
        .status-badge.selesai { background: #d1fae5; color: #065f46; }
        .status-badge.diambil { background: #e9d5ff; color: #6b21a8; }

        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_length select {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 6px 12px;
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 500;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #6366f1;
            outline: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 8px;
            padding: 8px 16px;
            margin: 0 4px;
            font-weight: 600;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-gradient) !important;
            color: white !important;
            border: none !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .revenue-stats {
                grid-template-columns: 1fr;
            }
            
            .stat-card h3 {
                font-size: 1.75rem;
            }

            .page-header, .filter-section, .chart-wrapper, .table-wrapper {
                padding: 20px;
            }
        }
    </style>
    @endpush

    <div class="container-fluid">
        {{-- Page Header --}}
        <div class="page-header">
            <h1>
                <span class="header-icon">
                    <i class="fas fa-chart-bar"></i>
                </span>
                Laporan Pendapatan
            </h1>
            <p>Analisis detail pendapatan dan transaksi laundry Anda</p>
        </div>

        {{-- Filter Section --}}
        <div class="filter-section">
            <h4><i class="fas fa-filter text-primary"></i> Filter Periode</h4>
            <form action="{{ route('admin.report.index') }}" method="GET" class="row g-3">
                <div class="col-md-5">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" 
                           value="{{ $startDate }}" required>
                </div>
                <div class="col-md-5">
                    <label for="end_date" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" 
                           value="{{ $endDate }}" required>
                </div>
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="fas fa-search"></i> Filter
                    </button>
                    <a href="{{ route('admin.report.index') }}" class="btn btn-secondary">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </form>
        </div>

        {{-- Statistics Cards --}}
        <div class="revenue-stats">
            <div class="stat-card purple">
                <div class="stat-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <h3>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                <p>Total Pendapatan</p>
            </div>

            <div class="stat-card pink">
                <div class="stat-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3>{{ $totalTransactions }}</h3>
                <p>Total Transaksi</p>
            </div>

            <div class="stat-card cyan">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Rp {{ number_format($totalPaid, 0, ',', '.') }}</h3>
                <p>Sudah Dibayar</p>
            </div>

            <div class="stat-card orange">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <h3>Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</h3>
                <p>Belum Dibayar</p>
            </div>
        </div>

        {{-- Chart Section --}}
        <div class="chart-wrapper">
            <h4>
                <span class="chart-icon">
                    <i class="fas fa-chart-area"></i>
                </span>
                Grafik Pendapatan Harian
            </h4>
            <canvas id="dailyRevenueChart" height="80"></canvas>
        </div>

        {{-- Export Buttons --}}
        <div class="export-section">
            <a href="{{ route('admin.report.exportPDF', ['start_date' => $startDate, 'end_date' => $endDate]) }}" 
               class="export-btn pdf">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ route('admin.report.exportExcel', ['start_date' => $startDate, 'end_date' => $endDate]) }}" 
               class="export-btn excel">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
        </div>

        {{-- Report Table --}}
        <div class="table-wrapper">
            <h4>
                <span class="chart-icon" style="background: linear-gradient(135deg, #14b8a6, #0d9488);">
                    <i class="fas fa-table"></i>
                </span>
                Detail Transaksi
            </h4>
            <div class="table-responsive">
                <table class="modern-table" id="reportTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KODE</th>
                            <th>TANGGAL</th>
                            <th>PELANGGAN</th>
                            <th>TOTAL</th>
                            <th>TERBAYAR</th>
                            <th>SISA</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $index => $transaction)
                        @php
                            $paid = $transaction->payments->sum('jumlah_bayar');
                            $remaining = $transaction->total_harga - $paid;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="transaction-code">{{ $transaction->kode_transaksi }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($transaction->tanggal_masuk)->format('d/m/Y H:i') }}</td>
                            <td><strong>{{ $transaction->customer->nama ?? 'N/A' }}</strong></td>
                            <td><strong>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</strong></td>
                            <td class="amount-paid">Rp {{ number_format($paid, 0, ',', '.') }}</td>
                            <td class="{{ $remaining > 0 ? 'amount-unpaid' : 'amount-paid' }}">
                                Rp {{ number_format($remaining, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="status-badge {{ $transaction->status }}">
                                    <i class="fas fa-circle"></i>
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center" style="padding: 40px;">
                                <i class="fas fa-inbox" style="font-size: 3rem; color: #d1d5db; margin-bottom: 16px;"></i>
                                <p style="color: #6b7280; margin: 0;">Tidak ada data transaksi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" style="text-align: right;">TOTAL:</th>
                            <th>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</th>
                            <th class="amount-paid">Rp {{ number_format($totalPaid, 0, ',', '.') }}</th>
                            <th class="amount-unpaid">Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#reportTable').DataTable({
                "pageLength": 25,
                "order": [[2, "desc"]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json"
                }
            });
        });

        // Daily Revenue Chart
        const dailyData = @json($dailyRevenue);
        const ctx = document.getElementById('dailyRevenueChart');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dailyData.map(item => {
                    const date = new Date(item.date);
                    return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
                }),
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: dailyData.map(item => item.revenue),
                    backgroundColor: (context) => {
                        const ctx = context.chart.ctx;
                        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.8)');
                        gradient.addColorStop(1, 'rgba(79, 70, 229, 0.8)');
                        return gradient;
                    },
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    borderRadius: 10,
                    hoverBackgroundColor: 'rgba(99, 102, 241, 1)',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 16,
                        borderRadius: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        callbacks: {
                            label: function(context) {
                                return 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#f3f4f6', drawBorder: false },
                        ticks: {
                            font: { size: 12, weight: '600' },
                            color: '#6b7280',
                            callback: function(value) {
                                return 'Rp ' + (value / 1000) + 'K';
                            }
                        }
                    },
                    x: {
                        grid: { display: false, drawBorder: false },
                        ticks: { 
                            font: { size: 12, weight: '600' }, 
                            color: '#6b7280' 
                        }
                    }
                }
            }
        });
    </script>
    @endpush
</x-admin>