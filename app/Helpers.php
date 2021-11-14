<?php

namespace App;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Helpers {
    static private function calculateTransactionDetail($transaction)
    {
        $tax = $transaction['pajak'];
        $addCost = $transaction['biaya_tambahan'];
        $disc = $transaction['diskon'];
        $subtotal = 0;

        foreach ($transaction['transaction_detail'] as $transactionDetail) {
            $subtotal += $transactionDetail['package']['harga'] * $transactionDetail['qty'];
        }

        $total = $subtotal + $tax + $addCost - $disc;

        return [
            'subtotal' => $subtotal,
            'total' => $total,
        ];
    }

    static public function injectCalculatedDataToTransactions($transactions)
    {
        for ($i = 0; $i < count($transactions); $i++) {
            $calculatedTransaction = self::calculateTransactionDetail($transactions[$i]->toArray());
            $transactions[$i]->total = $calculatedTransaction['total'];
            $transactions[$i]->subtotal = $calculatedTransaction['subtotal'];
        }

        return $transactions;
    }

    static public function checkMemberNameIsExists($memberName, $existMemberName = null)
    {
        if ($memberName === $existMemberName) {
            return false;
        } else {
            return Auth::user()->outlet->member()->where('nama', $memberName)->exists();
        }
    }

    static public function checkOutletNameIsExist($outletName, $existOutletName = null) {
        if ($outletName === $existOutletName) {
            return false;
        } else {
            return Outlet::where('nama', $outletName)->exists();
        }
    }

    static public function checkPackageNameIsExists($packageName, $existPackageName = null) {
        if ($packageName === $existPackageName) {
            return false;
        } else {
            return Auth::user()->outlet->package()->where('nama_paket', $packageName)->exists();
        }
    }

    static public function checkUserNameIsExist($username, $existUsername = null) {
        if ($username === $existUsername) {
            return false;
        } else {
            return User::where('username', $username)->exists();
        }
    }
}