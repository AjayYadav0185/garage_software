<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $g_id = auth_id() ?? 0;
        $today = Carbon::today();

        /* ===================== KPI ===================== */
        $totalCustomers = DB::table('customer')->where('g_id', $g_id)->count();
        $totalStocks = DB::table('inventory')->where('g_id', $g_id)->sum('Stock');

        $totalRevenue = DB::table('payment_history')
            ->where('g_id', $g_id)
            ->where('status', 'C')
            ->sum('amount');

        $totalExpenses =
            DB::table('misc_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('misc_amount') +
            DB::table('salary_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('salary_amount') +
            DB::table('spare_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('spare_amount') +
            DB::table('utility_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('utility_amount') +
            DB::table('sublet_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('sublet_amount');

        /* ===================== JOBS ===================== */
        $jobsCompletedToday = DB::table('jobcard')
            ->where('g_id', $g_id)
            ->whereDate('updated_at', $today)
            ->where('status', 'C')
            ->count();

        $jobsRunning = DB::table('jobcard')
            ->where('g_id', $g_id)
            ->whereIn('work_status', [2, 3])
            ->count();

        $pendingPayments = DB::table('jobcard')
            ->where('g_id', $g_id)
            ->where('status', 'P')
            ->sum('dueamount');

        /* ===================== SERVICE / INSURANCE ===================== */
        $totalServiceJobs = DB::table('jobcard')->where('g_id', $g_id)->where('job_card_type', 'service')->count();
        $serviceRunning = DB::table('jobcard')->where('g_id', $g_id)->where('job_card_type', 'service')->whereIn('work_status', [2, 3])->count();
        $serviceCompleted = DB::table('jobcard')->where('g_id', $g_id)->where('job_card_type', 'service')->where('status', 'C')->count();

        $totalInsuranceJobs = DB::table('jobcard')->where('g_id', $g_id)->where('job_card_type', 'accident')->count();
        $insuranceRunning = DB::table('jobcard')->where('g_id', $g_id)->where('job_card_type', 'accident')->whereIn('work_status', [2, 3])->count();
        $insuranceCompleted = DB::table('jobcard')->where('g_id', $g_id)->where('job_card_type', 'accident')->where('status', 'C')->count();

        /* ===================== TODAY ===================== */
        $todayRevenue = DB::table('payment_history')
            ->where('g_id', $g_id)
            ->whereDate('created_at', $today)
            ->sum('amount');

        $todayExpenses =
            DB::table('misc_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->whereDate('created_at', $today)->sum('misc_amount') +
            DB::table('salary_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->whereDate('created_at', $today)->sum('salary_amount') +
            DB::table('spare_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->whereDate('created_at', $today)->sum('spare_amount');

        $todayCash = DB::table('payment_history')
            ->where('g_id', $g_id)
            ->where('payment_type', 'Cash')
            ->whereDate('created_at', $today)
            ->sum('amount');

        $todayCard = DB::table('payment_history')
            ->where('g_id', $g_id)
            ->where('payment_type', 'Card')
            ->whereDate('created_at', $today)
            ->sum('amount');

        $todayBank = DB::table('payment_history')
            ->where('g_id', $g_id)
            ->where('payment_type', 'Bank Transfer')
            ->whereDate('created_at', $today)
            ->sum('amount');

        /* ===================== CHART FILTER ===================== */
        $revStart = $request->rev_start
            ? Carbon::parse($request->rev_start)->startOfMonth()
            : Carbon::now()->subMonths(5)->startOfMonth();

        $revEnd = $request->rev_end
            ? Carbon::parse($request->rev_end)->endOfMonth()
            : Carbon::now()->endOfMonth();

        /* ===================== REVENUE CHART ===================== */
        $revenueMonths = [];
        $revenueData = [];

        $cursor = $revStart->copy();
        while ($cursor <= $revEnd) {
            $revenueMonths[] = $cursor->format('M Y');

            $revenueData[] = DB::table('payment_history')
                ->where('g_id', $g_id)
                ->whereMonth('created_at', $cursor->month)
                ->whereYear('created_at', $cursor->year)
                ->sum('amount');

            $cursor->addMonth();
        }

        /* ===================== EXPENSE CHART ===================== */
        $expenseLabels = ['Salary', 'Spare', 'Utility', 'Misc', 'Sublet'];
        $expenseData = [
            DB::table('salary_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('salary_amount'),
            DB::table('spare_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('spare_amount'),
            DB::table('utility_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('utility_amount'),
            DB::table('misc_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('misc_amount'),
            DB::table('sublet_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('sublet_amount'),
        ];

        $totalRevenue = DB::table('payment_history')
            ->where('g_id', $g_id)
            ->where('status', 'C')
            ->sum('amount');

        $totalExpenses =
            DB::table('misc_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('misc_amount') +
            DB::table('salary_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('salary_amount') +
            DB::table('spare_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('spare_amount') +
            DB::table('utility_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('utility_amount') +
            DB::table('sublet_expenses')->where('payment_status_spare', 'Paid')->where('g_id', $g_id)->sum('sublet_amount');

        $cash = DB::table('payment_history')->where('g_id', $g_id)->where('payment_type', 'Cash')->sum('amount');
        $card = DB::table('payment_history')->where('g_id', $g_id)->where('payment_type', 'Card')->sum('amount');
        $bank = DB::table('payment_history')->where('g_id', $g_id)->where('payment_type', 'Bank Transfer')->sum('amount');

        return view('user.dashboard.index', compact(
            'totalCustomers',
            'totalStocks',
            'totalRevenue',
            'totalExpenses',
            'jobsCompletedToday',
            'jobsRunning',
            'pendingPayments',
            'totalServiceJobs',
            'serviceRunning',
            'serviceCompleted',
            'totalInsuranceJobs',
            'insuranceRunning',
            'insuranceCompleted',
            'todayRevenue',
            'todayExpenses',
            'todayCash',
            'todayCard',
            'todayBank',
            'cash',
            'card',
            'bank',
            'revenueMonths',
            'revenueData',
            'expenseLabels',
            'expenseData'
        ));
    }

    public function indexStatic(Request $request)
    {

        // ================= KPI DATA =================
        $totalCustomers = 120;
        $totalStocks = 340;
        $totalRevenue = 136727.80;
        $totalExpenses = 2400.00;

        // ================= JOBS =================
        $jobsCompletedToday = 8;
        $jobsRunning = 3;
        $pendingPayments = 1250;

        $totalServiceJobs = 45;
        $serviceRunning = 5;
        $serviceCompleted = 40;

        $totalInsuranceJobs = 20;
        $insuranceRunning = 2;
        $insuranceCompleted = 18;

        // ================= TODAY SUMMARY =================
        $todayRevenue = 5200;
        $todayExpenses = 1200;
        $todayCash = 12000;
        $todayCard = 12200;
        $todayBank = 11000;
        $cash = 2000;
        $card = 2200;
        $bank = 1000;

        // ================= CHART DATA =================
        $revenueMonths = [
            'Aug 2025',
            'Sep 2025',
            'Oct 2025',
            'Nov 2025',
            'Dec 2025',
            'Jan 2026'
        ];

        $revenueData = [
            18000,
            22000,
            19500,
            24000,
            29000,
            25227.80
        ];

        $expenseLabels = ['Salary', 'Spare', 'Utility', 'Misc', 'Sublet'];

        $expenseData = [
            1200,
            800,
            300,
            100,
            200
        ];

        return view('user.dashboard.index', compact(
            'totalCustomers',
            'totalStocks',
            'totalRevenue',
            'totalExpenses',
            'jobsCompletedToday',
            'jobsRunning',
            'pendingPayments',
            'totalServiceJobs',
            'serviceRunning',
            'serviceCompleted',
            'totalInsuranceJobs',
            'insuranceRunning',
            'insuranceCompleted',
            'todayRevenue',
            'todayExpenses',
            'todayCash',
            'todayCard',
            'todayBank',
            'cash',
            'card',
            'bank',
            'revenueMonths',
            'revenueData',
            'expenseLabels',
            'expenseData'
        ));
    }
}
