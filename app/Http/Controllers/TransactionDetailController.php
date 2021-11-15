<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TransactionDetailController extends Controller
{
    static private $validationUpdateSchema = [
        'qty' => ['required', 'numeric', 'min:1'],
        'keterangan' => ['nullable'],
    ];

    public function handleCreate(Transaction $transaction, Request $request)
    {
        $packageId = $request->id_paket;

        $transaction->transactionDetail()->create([
            'id_paket' => $packageId,
            'qty' => 1,
            'keterangan' => '',
        ]);

        Log::info('Create transaction detail: package ' . $packageId . ' to ' . $transaction->kode_invoice . ' by user ' . Auth::user()->id);

        return back();
    }

    public function handleUpdate(TransactionDetail $transactionDetail, Request $request)
    {
        $data = $request->validate(self::$validationUpdateSchema);

        $transactionDetail->update($data);

        Log::info('Update transaction detail :' . $transactionDetail->id . ' with ' . json_encode($data) . ' by user ' . Auth::user()->id);

        return back();
    }

    public function handleDelete(TransactionDetail $transactionDetail)
    {
        $transactionDetail->delete();

        Log::info('Delete transaction detail: ' . $transactionDetail->id . ', by user ' . Auth::user()->id);

        return back();
    }
}
