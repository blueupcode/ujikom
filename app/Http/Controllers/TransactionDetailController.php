<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    static private $validationUpdateSchema = [
        'qty' => 'required|numeric|min:1',
        'keterangan' => 'nullable',
    ];

    public function handleCreate(Transaction $transaction, Request $request)
    {
        $packageId = $request->id_paket;

        $transaction->transactionDetail()->create([
            'id_paket' => $packageId,
            'qty' => 1,
            'keterangan' => '',
        ]);

        return back();
    }

    public function handleUpdate(TransactionDetail $transactionDetail, Request $request)
    {
        $data = $request->validate(self::$validationUpdateSchema);

        $transactionDetail->update($data);

        return back();
    }

    public function handleDelete(TransactionDetail $transactionDetail)
    {
        $transactionDetail->delete();

        return back();
    }
}
