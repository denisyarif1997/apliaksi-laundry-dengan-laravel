<style>
    /* 🎨 Modern Dashboard 2025 - Premium Design */
    :root {
        --primary: #6366f1;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #3b82f6;
        --purple: #8b5cf6;
        --pink: #ec4899;
        --teal: #14b8a6;
    }

    /* Dashboard Stats Card */
    .stats-card {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        background: linear-gradient(135deg, var(--gradient-from), var(--gradient-to));
        box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.15);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        height: 100%;
    }

    .stats-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 20px 60px -10px rgba(0, 0, 0, 0.25);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .stats-card:hover::before {
        opacity: 1;
    }

    .stats-card .card-body {
        padding: 28px 24px;
        position: relative;
        z-index: 2;
    }

    .stats-icon {
        width: 64px;
        height: 64px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: all 0.3s;
    }

    .stats-card:hover .stats-icon {
        transform: rotate(10deg) scale(1.1);
    }

    .stats-icon i {
        font-size: 28px;
        color: white;
    }

    .stats-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 8px;
        line-height: 1;
        letter-spacing: -1px;
    }

    .stats-label {
        font-size: 0.95rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.9);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
    }

    .stats-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    .stats-link {
        color: white;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .stats-link:hover {
        color: white;
        transform: translateX(4px);
    }

    /* Gradient Colors */
    .gradient-info { --gradient-from: #3b82f6; --gradient-to: #2563eb; }
    .gradient-warning { --gradient-from: #f59e0b; --gradient-to: #d97706; }
    .gradient-primary { --gradient-from: #6366f1; --gradient-to: #4f46e5; }
    .gradient-success { --gradient-from: #10b981; --gradient-to: #059669; }
    .gradient-teal { --gradient-from: #14b8a6; --gradient-to: #0d9488; }
    .gradient-pink { --gradient-from: #ec4899; --gradient-to: #db2777; }
    .gradient-purple { --gradient-from: #8b5cf6; --gradient-to: #7c3aed; }
    .gradient-danger { --gradient-from: #ef4444; --gradient-to: #dc2626; }

    /* Section Header */
    .section-header {
        margin-bottom: 32px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-header h2 {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1f2937;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-header .badge {
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    /* Quick Action Buttons */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .action-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .action-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        border-color: var(--color);
    }

    .action-card-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        background: var(--color);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .action-card-icon i {
        font-size: 28px;
        color: white;
    }

    .action-card-content h5 {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 4px 0;
    }

    .action-card-content p {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0;
    }

    /* Chart Cards */
    .chart-card {
        background: white;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 32px;
        border: 1px solid #f3f4f6;
    }

    .chart-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
    }

    .chart-card-header h4 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1f2937;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chart-card-header .chart-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chart-card-header .chart-icon i {
        color: white;
        font-size: 18px;
    }

    /* Transactions Table */
    .transactions-wrapper {
        background: white;
        border-radius: 24px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #f3f4f6;
    }

    .transactions-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
    }

    .transactions-header h4 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1f2937;
        margin: 0;
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
        transform: scale(1.01);
    }

    .modern-table tbody td {
        padding: 20px;
        color: #1f2937;
        font-weight: 500;
        border-bottom: 1px solid #f3f4f6;
    }

    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    .transaction-code {
        font-weight: 700;
        color: #6366f1;
        font-family: 'Courier New', monospace;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-badge i {
        font-size: 10px;
    }

    .status-pending { background: #fef3c7; color: #92400e; }
    .status-processing { background: #dbeafe; color: #1e40af; }
    .status-completed { background: #d1fae5; color: #065f46; }
    .status-diambil { background: #e9d5ff; color: #6b21a8; }

    /* Responsive */
    @media (max-width: 768px) {
        .stats-value { font-size: 2rem; }
        .chart-card { padding: 20px; }
        .transactions-wrapper { padding: 20px; }
    }
</style>

<!-- Statistics Cards Row 1 -->
<div class="row g-4 mb-4">
    @role('admin')
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-info">
                <div class="card-body">
                    <div class="stats-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stats-value">{{ $totalTransactions }}</div>
                    <div class="stats-label">Total Transaksi</div>
                    <div class="stats-footer">
                        <a href="{{ route('admin.transaction.index') }}" class="stats-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-warning">
                <div class="card-body">
                    <div class="stats-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stats-value">{{ $pendingTransactions }}</div>
                    <div class="stats-label">Transaksi Pending</div>
                    <div class="stats-footer">
                        <a href="{{ route('admin.transaction.index') }}" class="stats-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-primary">
                <div class="card-body">
                    <div class="stats-icon">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="stats-value">{{ $processingTransactions }}</div>
                    <div class="stats-label">Sedang Diproses</div>
                    <div class="stats-footer">
                        <a href="{{ route('admin.collection.index') }}" class="stats-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-success">
                <div class="card-body">
                    <div class="stats-icon">
                        <i class="fas fa-check-double"></i>
                    </div>
                    <div class="stats-value">{{ $diambilTransactions }}</div>
                    <div class="stats-label">Transaksi Selesai</div>
                    <div class="stats-footer">
                        <a href="{{ route('admin.collection.index') }}" class="stats-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endrole
</div>

<!-- Statistics Cards Row 2 -->
<div class="row g-4 mb-5">
    @role('admin')
        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-success">
                <div class="card-body">
                    <div class="stats-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="stats-value" style="font-size: 1.75rem;">Rp {{ number_format($totalRevenue / 1000, 0) }}K</div>
                    <div class="stats-label">Total Pendapatan</div>
                    <div class="stats-footer">
                        <a href="#" class="stats-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-teal">
                <div class="card-body">
                    <div class="stats-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stats-value" style="font-size: 1.75rem;">Rp {{ number_format($monthlyRevenue / 1000, 0) }}K</div>
                    <div class="stats-label">Bulan Ini</div>
                    <div class="stats-footer">
                        <a href="#" class="stats-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-pink">
                <div class="card-body">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-value">{{ $totalCustomers }}</div>
                    <div class="stats-label">Total Pelanggan</div>
                    <div class="stats-footer">
                        <a href="#" class="stats-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card gradient-purple">
                <div class="card-body">
                    <div class="stats-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="stats-value">{{ $activeMachines }}/{{ $totalMachines }}</div>
                    <div class="stats-label">Mesin Aktif</div>
                    <div class="stats-footer">
                        <a href="#" class="stats-link">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endrole
</div>

<!-- Quick Actions -->
@role('admin')
<div class="section-header">
    <h2>
        <span class="chart-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
            <i class="fas fa-bolt"></i>
        </span>
        Quick Actions
    </h2>
</div>

<div class="quick-actions-grid mb-5">
    <a href="{{ route('admin.transaction.create') }}" class="action-card" style="--color: #3b82f6;">
        <div class="action-card-icon">
            <i class="fas fa-plus-circle"></i>
        </div>
        <div class="action-card-content">
            <h5>Transaksi Baru</h5>
            <p>Buat transaksi laundry baru</p>
        </div>
    </a>

    <a href="{{ route('admin.customer.index') }}" class="action-card" style="--color: #10b981;">
        <div class="action-card-icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <div class="action-card-content">
            <h5>Pelanggan Baru</h5>
            <p>Tambah pelanggan baru</p>
        </div>
    </a>

    <a href="{{ route('admin.services.index') }}" class="action-card" style="--color: #8b5cf6;">
        <div class="action-card-icon">
            <i class="fas fa-box-open"></i>
        </div>
        <div class="action-card-content">
            <h5>Kelola Layanan</h5>
            <p>Atur layanan laundry</p>
        </div>
    </a>
</div>
@endrole

<!-- Charts Row -->
<div class="row g-4 mb-4">
    @role('admin')
        <div class="col-lg-8">
            <div class="chart-card">
                <div class="chart-card-header">
                    <h4>
                        <span class="chart-icon">
                            <i class="fas fa-chart-area"></i>
                        </span>
                        Grafik Pendapatan
                    </h4>
                    <span class="badge bg-primary">6 Bulan Terakhir</span>
                </div>
                <canvas id="revenueChart" height="80"></canvas>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="chart-card">
                <div class="chart-card-header">
                    <h4>
                        <span class="chart-icon" style="background: linear-gradient(135deg, #ec4899, #db2777);">
                            <i class="fas fa-chart-pie"></i>
                        </span>
                        Status Transaksi
                    </h4>
                </div>
                <canvas id="statusChart" height="240"></canvas>
            </div>
        </div>
    @endrole
</div>

<!-- Recent Transactions -->
@role('admin')
<div class="transactions-wrapper">
    <div class="transactions-header">
        <h4>
            <span class="chart-icon" style="background: linear-gradient(135deg, #14b8a6, #0d9488);">
                <i class="fas fa-history"></i>
            </span>
            Transaksi Terbaru
        </h4>
        <span class="badge bg-secondary">{{ count($recentTransactions) }} Transaksi</span>
    </div>
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>KODE TRANSAKSI</th>
                    <th>PELANGGAN</th>
                    <th>TANGGAL</th>
                    <th>TOTAL</th>
                    <th>STATUS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $transaction)
                <tr>
                    <td><span class="transaction-code">{{ $transaction->kode_transaksi }}</span></td>
                    <td><strong>{{ $transaction->customer->nama ?? 'N/A' }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($transaction->tanggal_masuk)->format('d M Y') }}</td>
                    <td><strong style="color: #10b981;">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</strong></td>
                    <td>
                        <span class="status-badge status-{{ $transaction->status }}">
                            <i class="fas fa-circle"></i>
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 40px;">
                        <i class="fas fa-inbox" style="font-size: 3rem; color: #d1d5db; margin-bottom: 16px;"></i>
                        <p style="color: #6b7280; margin: 0;">Tidak ada transaksi</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endrole

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart');
    if (revenueCtx) {
        const monthlyData = @json($monthlyData);
        const labels = monthlyData.map(item => {
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            return months[item.month - 1] + ' ' + item.year;
        });
        const revenues = monthlyData.map(item => item.revenue);

        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: revenues,
                    borderColor: '#6366f1',
                    backgroundColor: (context) => {
                        const ctx = context.chart.ctx;
                        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
                        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
                        gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');
                        return gradient;
                    },
                    tension: 0.4,
                    fill: true,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#6366f1',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 3,
                    borderWidth: 3
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
                        ticks: { font: { size: 12, weight: '600' }, color: '#6b7280' }
                    }
                }
            }
        });
    }

    // Status Chart
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Proses', 'Selesai', 'Diambil'],
                datasets: [{
                    data: [{{ $pendingTransactions }}, {{ $processingTransactions }}, {{ $completedTransactions }}, {{ $diambilTransactions }}],
                    backgroundColor: ['#f59e0b', '#6366f1', '#10b981', '#8b5cf6'],
                    borderWidth: 0,
                    hoverOffset: 12
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: { size: 12, weight: '600' },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        padding: 12,
                        borderRadius: 8,
                        bodyFont: { size: 13, weight: '600' }
                    }
                }
            }
        });
    }
});
</script>