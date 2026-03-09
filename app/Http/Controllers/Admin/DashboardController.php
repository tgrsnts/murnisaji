<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Income (sum of all completed/paid transactions)
        $totalIncome = Transaksi::sum('total_bayar');

        // Total Orders
        $totalOrders = Transaksi::count();

        // Total Delivered (DONE status)
        $totalDelivered = Transaksi::where('status', 'DONE')->count();

        // Total Customers (users with role 0)
        $totalCustomers = User::where('role', 0)->count();

        // Order Status Counts
        $statusPending = Transaksi::where('status', 'PENDING')->count();
        $statusPaid = Transaksi::where('status', 'PAID')->count();
        $statusPacked = Transaksi::where('status', 'PACKED')->count();
        $statusShipped = Transaksi::where('status', 'SHIPPED')->count();
        $statusDone = Transaksi::where('status', 'DONE')->count();
        $statusCancel = Transaksi::where('status', 'CANCEL')->count();

        // Recent Orders (5 latest)
        $recentOrders = Transaksi::with('user')
            ->latest()
            ->limit(5)
            ->get();

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
        ]);
    }
}
