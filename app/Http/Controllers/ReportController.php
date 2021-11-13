<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function viewReport(Request $request)
    {
        $outlet = Auth::user()->outlet;

        if ($request->start && $request->end) {
            $times = [
                'start' => Carbon::parse($request->start)->toDateString(),
                'end' => Carbon::parse($request->end)->addDays(1)->toDateString(),
            ];
        } else {
            $times = [
                'start' => Carbon::now()->subDays(10)->toDateString(),
                'end' => Carbon::now()->addDays(1)->toDateString(),
            ];
        }

        $transactions = $outlet
            ->transaction()
            ->whereBetween('created_at', [$times['start'], $times['end']])
            ->whereIn('status', ['selesai', 'diambil'])
            ->where('dibayar', 'dibayar')
            ->with(['member', 'transactionDetail', 'transactionDetail.package'])
            ->get();
        $transactions = Helpers::injectCalculatedDataToTransactions($transactions);

        $members = $outlet
            ->member()
            ->whereBetween('created_at', [$times['start'], $times['end']])
            ->get();

        return view('dashboard.report.index', [
            'transactions' => $transactions,
            'members' => $members,
            'times' => $times,
        ]);
    }

    public function printReportTransaction($start, $end)
    {
        $transactions = Auth::user()->outlet
            ->transaction()
            ->whereBetween('created_at', [$start, $end])
            ->whereIn('status', ['selesai', 'diambil'])
            ->where('dibayar', 'dibayar')
            ->with(['member', 'transactionDetail', 'transactionDetail.package'])
            ->get();
        $transactions = Helpers::injectCalculatedDataToTransactions($transactions);
        
        $summary = [
            'total_pesanan' => 0,
            'subtotal' => 0,
            'biaya_tambahan' => 0,
            'pajak' => 0,
            'diskon' => 0,
            'total' => 0,
        ];

        foreach ($transactions as $transaction) {
            $summary['total_pesanan'] += count($transaction->transactionDetail);
            $summary['subtotal'] += $transaction->subtotal;
            $summary['biaya_tambahan'] += $transaction->biaya_tambahan;
            $summary['pajak'] += $transaction->pajak;
            $summary['diskon'] += $transaction->diskon;
            $summary['total'] += $transaction->total;
        }

        return view('report.transaction', [
            'transactions' => $transactions,
            'summary' => $summary,
            'times' => [
                'start' => $start,
                'end' => $end,
            ]
        ]);
    }

    public function printReportMember($start, $end)
    {
        $members = Auth::user()->outlet
            ->member()
            ->whereBetween('created_at', [$start, $end])
            ->get();

        return view('report.member', [
            'members' =>$members,
            'times' => [
                'start' => $start,
                'end' => $end,
            ]
        ]);
    }
}
