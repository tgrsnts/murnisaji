<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Income (sum of all completed/paid transactions)
        $totalIncome = Transaksi::sum('total_bayar');

        // Total Orders
        $totalOrders = Transaksi::count();

        // Total Delivered (DELIVERED status)
        $totalDelivered = Transaksi::where('status', 'DELIVERED')->count();

        // Total Customers (users with role 0)
        $totalCustomers = User::where('role', 0)->count();

        // Order Status Counts
        $statusPending = Transaksi::where('status', 'PENDING')->count();
        $statusPaid = Transaksi::where('status', 'PAID')->count();
        $statusPacked = Transaksi::where('status', 'PACKED')->count();
        $statusShipped = Transaksi::where('status', 'SHIPPED')->count();
        $statusDone = Transaksi::where('status', 'DELIVERED')->count();
        $statusCancel = Transaksi::where('status', 'CANCEL')->count();

        // Recent Orders (5 latest)
        $recentOrders = Transaksi::with('user')
            ->latest()
            ->limit(5)
            ->get();

        $months = collect();

        // ambil 6 bulan terakhir (termasuk bulan ini)
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i));
        }

        // ambil data dari DB
        $monthlyOrders = DB::table('transaksis')
            ->selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereBetween('created_at', [
                $months->first()->startOfMonth(),
                $months->last()->endOfMonth()
            ])
            ->groupBy('tahun', 'bulan')
            ->get()
            ->keyBy(fn($item) => $item->tahun . '-' . $item->bulan);

        // mapping ke chart
        $chartData = [];
        $labels = [];

        foreach ($months as $month) {
            $key = $month->year . '-' . $month->month;

            $chartData[] = $monthlyOrders[$key]->total ?? 0;
            $labels[] = $month->format('M'); // Jul, Aug, dst
        }

        return view('admin.index', [
            'title' => 'Dashboard',
            'totalIncome' => $totalIncome,
            'totalOrders' => $totalOrders,
            'totalDelivered' => $totalDelivered,
            'totalCustomers' => $totalCustomers,
            'statusPending' => $statusPending,
            'statusPaid' => $statusPaid,
            'statusPacked' => $statusPacked,
            'statusShipped' => $statusShipped,
            'statusDone' => $statusDone,
            'statusCancel' => $statusCancel,
            'recentOrders' => $recentOrders,
            'chartData' => $chartData,
            'labels' => $labels
        ]);
    }
}
