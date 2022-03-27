<?php

namespace App;

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
}