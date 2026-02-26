<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Bread;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalBreads = Bread::count();
        $totalUsers = User::count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'totalBreads',
            'totalUsers',
            'recentOrders',
        ));
    }

    // Return JSON revenue data for the last N days (default 30)
    public function revenueData(Request $request)
    {
        $days = (int) $request->query('days', 30);
        $end = now()->endOfDay();
        $start = now()->subDays($days - 1)->startOfDay();

        $rows = Order::selectRaw("DATE(created_at) as date, SUM(total_amount) as total")
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('total', 'date')
            ->toArray();

        $labels = [];
        $data = [];

        for ($i = 0; $i < $days; $i++) {
            $d = $start->copy()->addDays($i)->toDateString();
            $labels[] = $d;
            $data[] = isset($rows[$d]) ? (float) $rows[$d] : 0.0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data,
        ]);
    }
}
