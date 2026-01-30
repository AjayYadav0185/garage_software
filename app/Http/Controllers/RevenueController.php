<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use Carbon\Carbon;
use PDF; 


class RevenueController extends Controller
{
    public function index(Request $request)
    {

        $revStart = $request->rev_start ?? now()->subMonths(5)->format('Y-m');
        $revEnd = $request->rev_end ?? now()->format('Y-m');

        $start = Carbon::parse($revStart)->startOfMonth();
        $end   = Carbon::parse($revEnd)->endOfMonth();

        // Query from PaymentHistory
        $revenue = PaymentHistory::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(amount) as total")
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Prepare for table + charts
        $revMonths = [];
        foreach ($revenue as $r) {
            $revMonths[$r->month] = $r->total;
        }

        $revenueLabels = collect(array_keys($revMonths))
            ->map(fn($m) => date("F Y", strtotime($m . "-01")));

        $revenueData = array_values($revMonths);
        $revenueTotal = array_sum($revenueData);

        // Example KPIs matching your existing dashboard style
        $totalpending = PaymentHistory::count(); // change as needed
        $totalavgw = PaymentHistory::avg('amount') ?? 0;
        $todaytotaloeder = PaymentHistory::whereDate('created_at', today())->count();
        $totalRTO = PaymentHistory::where('status', 'complete')->count(); // example


        return view('revenue.index', compact(
            'revStart',
            'revEnd',
            'revMonths',
            'revenueLabels',
            'revenueData',
            'revenueTotal',
            'totalpending',
            'totalavgw',
            'todaytotaloeder',
            'totalRTO'
        ));
    }


    public function download(Request $request)
    {
        $revEnd = $request->rev_end ?? now()->format('Y-m');
        $revStart = $request->rev_start ?? now()->subMonths(5)->format('Y-m');

        $start = Carbon::parse($revStart)->startOfMonth();
        $end   = Carbon::parse($revEnd)->endOfMonth();

        $revenue = PaymentHistory::selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(amount) as total")
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $pdf = PDF::loadView('revenue.revenue_pdf', [
            'revenue' => $revenue,
            'revStart' => $revStart,
            'revEnd' => $revEnd
        ])->setPaper('a4', 'portrait');

        return $pdf->download("revenue_{$revStart}_to_{$revEnd}.pdf");
    }
}
