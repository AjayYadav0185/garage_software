<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\JobCard;

/*
|--------------------------------------------------------------------------
| Role Checker
|--------------------------------------------------------------------------
*/
if (!function_exists('checkRole')) {
    function checkRole($role)
    {
        return Auth::check() && Auth::user()->role === $role;
    }
}

/*
|--------------------------------------------------------------------------
| Job Card + Invoice Generator
|--------------------------------------------------------------------------
*/
if (!function_exists('generateJobCardNumbers')) {
    function generateJobCardNumbers($garageId = null)
    {
        /*
        |-----------------------------------------
        | Garage Prefix (3 letters)
        |-----------------------------------------
        */
        $prefix = 'GAR';

        if ($garageId) {
            $garageName = DB::table('call_login')
                ->where('g_id', $garageId)
                ->value('g_name');

            if ($garageName) {
                $letters = preg_replace('/[^A-Z]/', '', strtoupper($garageName));
                $prefix = substr($letters, 0, 3) ?: 'GAR';
            }
        }

        /*
        |-----------------------------------------
        | Job Card Number
        | Format: ABC/JC/001
        |-----------------------------------------
        */
        $lastJobCard = JobCard::where('job_card_no', 'like', "{$prefix}/JC/%")
            ->orderByRaw("CAST(SUBSTRING_INDEX(job_card_no, '/', -1) AS UNSIGNED) DESC")
            ->first();

        $nextNumber = 1;

        if ($lastJobCard) {
            $lastPart = explode('/', $lastJobCard->job_card_no);
            $nextNumber = ((int) end($lastPart)) + 1;
        }

        $jobCardNo = strtoupper(
            $prefix . '/JC/' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT)
        );

        /*
        |-----------------------------------------
        | Invoice Number
        |-----------------------------------------
        */
        $invoiceNo = generateInvoiceNumber($prefix);

        return [
            'job_card_no' => $jobCardNo,
            'invoice_no'  => $invoiceNo,
        ];
    }
}

/*
|--------------------------------------------------------------------------
| Invoice Generator
| Format: INJANGAR01
|--------------------------------------------------------------------------
*/
if (!function_exists('generateInvoiceNumber')) {
    function generateInvoiceNumber($prefix)
    {
        $month = strtoupper(date('M')); // JAN
        $year  = date('Y');

        // Get last invoice for same month + prefix
        $lastInvoice = DB::table('jobcard')
            ->where('invoice_no', 'like', "IN{$month}{$prefix}%")
            ->whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->value('invoice_no');

        $serial = 1;

        if ($lastInvoice) {
            // Extract last 2 digits safely
            $serial = (int) substr($lastInvoice, -2) + 1;
        }

        $serialPart = str_pad($serial, 2, '0', STR_PAD_LEFT);

        return "IN{$month}{$prefix}{$serialPart}";
    }
}
