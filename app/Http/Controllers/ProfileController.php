<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\TransactionModel;
use App\Models\CustomerModel;
use App\Models\MesinCuciModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function dashboard()
    {
        // Transaction Stats
        $totalTransactions = TransactionModel::count();
        $pendingTransactions = TransactionModel::where('status', 'pending')->count();
        $processingTransactions = TransactionModel::where('status', 'proses')->count();
        $diambilTransactions = TransactionModel::where('status', 'diambil')->orWhere('status', 'selesai')->count();
        $completedTransactions = TransactionModel::where('status', 'selesai')->count(); // Just for chart or completeness

        // Revenue Stats
        $totalRevenue = TransactionModel::sum('total_harga');
        $monthlyRevenue = TransactionModel::whereMonth('created_at', \Carbon\Carbon::now()->month)
                            ->whereYear('created_at', \Carbon\Carbon::now()->year)
                            ->sum('total_harga');

        // Master Data Stats
        $totalCustomers = CustomerModel::count();
        $totalMachines = MesinCuciModel::count();
        $activeMachines = MesinCuciModel::where('status', 1)->count(); // 1 = Active

        // Recent Transactions
        $recentTransactions = TransactionModel::with('customer')->latest()->take(5)->get();

        // Chart Data (Last 6 months)
        $monthlyData = TransactionModel::select(
            \Illuminate\Support\Facades\DB::raw('sum(total_harga) as revenue'), 
            \Illuminate\Support\Facades\DB::raw("DATE_FORMAT(created_at,'%m') as month"),
            \Illuminate\Support\Facades\DB::raw("DATE_FORMAT(created_at,'%Y') as year")
        )
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->take(6)
        ->get()
        ->reverse()
        ->values();

        return view('dashboard', compact(
            'totalTransactions',
            'pendingTransactions',
            'processingTransactions',
            'diambilTransactions',
            'completedTransactions',
            'totalRevenue',
            'monthlyRevenue',
            'totalCustomers',
            'totalMachines',
            'activeMachines',
            'recentTransactions',
            'monthlyData'
        ));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // dd($request->post());
        // dd($request->user());
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        User::where('id', $request->user()->id)->update(['mode'=>$request->mode]);

        $request->user()->save();

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
}
