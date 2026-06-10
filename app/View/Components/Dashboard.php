<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use App\Models\User;
use App\Models\TransactionModel;
use App\Models\CustomerModel;
use App\Models\PaymentModel;
use App\Models\MesinCuciModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Existing statistics
        $user = User::count();
        view()->share('user',$user);
        
        $category = Category::count();
        view()->share('category',$category);
        
        $product = Product::count();
        view()->share('product',$product);
        
        $collection = Collection::count();
        view()->share('collection',$collection);
        
        // New statistics - Transactions
        $totalTransactions = TransactionModel::count();
        view()->share('totalTransactions', $totalTransactions);
        
        $pendingTransactions = TransactionModel::where('status', 'pending')->count();
        view()->share('pendingTransactions', $pendingTransactions);
        
        $completedTransactions = TransactionModel::where('status', 'selesai')->count();
        view()->share('completedTransactions', $completedTransactions);
        
        $processingTransactions = TransactionModel::where('status', 'proses')->count();
        view()->share('processingTransactions', $processingTransactions);

        $diambilTransactions = TransactionModel::where('status', 'diambil')->count();
        view()->share('diambilTransactions', $diambilTransactions);
        
        // Revenue statistics
        $totalRevenue = TransactionModel::sum('total_harga') ?? 0;
        view()->share('totalRevenue', $totalRevenue);
        
        $monthlyRevenue = TransactionModel::whereMonth('tanggal_masuk', date('m'))
            ->whereYear('tanggal_masuk', date('Y'))
            ->sum('total_harga') ?? 0;
        view()->share('monthlyRevenue', $monthlyRevenue);
        
        // Customer statistics
        $totalCustomers = CustomerModel::count();
        view()->share('totalCustomers', $totalCustomers);
        
        // Payment statistics
        $totalPayments = PaymentModel::sum('jumlah_bayar') ?? 0;
        view()->share('totalPayments', $totalPayments);
        
        // Machine statistics
        $totalMachines = MesinCuciModel::count();
        view()->share('totalMachines', $totalMachines);
        
        $activeMachines = MesinCuciModel::where('status', 'aktif')->count();
        view()->share('activeMachines', $activeMachines);
        
        // Recent transactions (last 5)
        $recentTransactions = TransactionModel::with('customer')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        view()->share('recentTransactions', $recentTransactions);
        
        // Monthly revenue chart data (last 6 months)
        $monthlyData = TransactionModel::select(
                DB::raw('MONTH(tanggal_masuk) as month'),
                DB::raw('YEAR(tanggal_masuk) as year'),
                DB::raw('SUM(total_harga) as revenue'),
                DB::raw('COUNT(*) as count')
            )
            ->where('tanggal_masuk', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        view()->share('monthlyData', $monthlyData);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard');
    }
}
