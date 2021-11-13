<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\Member;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    static private $listLength = 10;
    static private $status = [
        'baru',
        'proses',
        'selesai',
        'diambil',
    ];

    static private $validationUpdateInvoiceSchema = [
        'pajak' => 'required|numeric|min:0',
        'biaya_tambahan' => 'required|numeric|min:0',
        'diskon' => 'required|numeric|min:0',
        'batas_waktu' => 'required|date',
    ];

    private function getNewStatus($currentStatus)
    {
        try {
            $statusIndex = array_search($currentStatus, self::$status);
            return self::$status[$statusIndex + 1];
        } catch (\Throwable $th) {
            return $currentStatus;
        }
    }

    public function viewTransaction(Request $request)
    {
        $memberSearchQuery = $request->member_search;

        $members = Auth::user()
            ->outlet
            ->member()
            ->orderBy('id', 'DESC');

        if ($memberSearchQuery) {
            $members = $members->where('nama', 'LIKE', "%{$memberSearchQuery}%");
        }

        $members = $members
            ->limit(self::$listLength)
            ->get();

        $transactions = Auth::user()
            ->outlet
            ->transaction()
            ->orderBy('id', 'DESC')
            ->with(['member', 'transactionDetail', 'transactionDetail.package'])
            ->paginate(self::$listLength);

        $transactions = Helpers::injectCalculatedDataToTransactions($transactions);

        return view('dashboard.transaction.index', [
            'members' => $members,
            'transactions' => $transactions
        ]);
    }

    public function viewTransactionDetail($invoiceCode)
    {
        $transaction = Transaction::where('kode_invoice', $invoiceCode)->first();
        $member = $transaction->member;
        $transactionDetail = $transaction->transactionDetail()->orderBy('id', 'DESC')->with('package')->get();
        $packages = Auth::user()->outlet->package()->orderBy('id', 'DESC')->get();

        $transaction->batas_waktu_formated = Carbon::parse($transaction->batas_waktu)->toDateTimeLocalString();

        $transactionSubtotal = 0;

        foreach ($transactionDetail->toArray() as $transactionDetailItem) {
            $transactionSubtotal += $transactionDetailItem['package']['harga'] * $transactionDetailItem['qty'];
        }

        $transactionTotal = $transactionSubtotal + $transaction->pajak + $transaction->biaya_tambahan - $transaction->diskon;

        $transaction->subtotal = $transactionSubtotal;
        $transaction->total = $transactionTotal;
        $transaction->status_new = $this->getNewStatus($transaction->status);

        return view('dashboard.transaction.detail', [
            'member' => $member,
            'packages' => $packages,
            'transaction' => $transaction,
            'transactionDetail' => $transactionDetail,
        ]);
    }

    public function handleCreate(Member $member)
    {
        $transaction = $member->outlet->transaction()->create([
            'kode_invoice' => Str::uuid(),
            'id_member' => $member->id,
            'id_user' => Auth::user()->id,
            'tgl' => Carbon::now(),
            'batas_waktu' => Carbon::now()->addDay(5),
            'biaya_tambahan' => 0,
            'diskon' => 0,
            'pajak' => 0,
            'status' => 'baru',
            'dibayar' => 'belum_dibayar',
        ]);

        return redirect()->route('transactionDetail', [
            'invoiceCode' => $transaction->kode_invoice,
        ]);
    }

    public function handleUpdateInvoice(Transaction $transaction, Request $request)
    {
        $data = $request->validate(self::$validationUpdateInvoiceSchema);

        $transaction->update($data);

        return back();
    }

    public function handlePayment(Transaction $transaction)
    {
        $transaction->update([
            'dibayar' => 'dibayar',
            'tgl_bayar' => Carbon::now()->toDateTimeString(),
        ]);

        return back();
    }

    public function handleProcess(Transaction $transaction)
    {
        $newStatus = $this->getNewStatus($transaction->status);
        
        $transaction->update([
            'status' => $newStatus,
        ]);

        return back();
    }

    public function handleDelete(Transaction $transaction) {
        $transaction->delete();
        
        return redirect()->route('transaction');
    }
}
