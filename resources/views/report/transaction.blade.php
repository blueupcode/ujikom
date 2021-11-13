@extends('_layouts.print')

@php ($page_title = 'Laporan Transaksi '.$times['start'].' sampai '.$times['end'])

@section('content')
    <h1 class="text-center mb-5">Laporan Transaksi {{ $times['start'] }} sampai {{ $times['end'] }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Kode invoice</td>
                <td>Pemesan</td>
                <td>Total Pesanan</td>
                <td>Subtotal</td>
                <td>Biaya tambahan</td>
                <td>Pajak</td>
                <td>Diskon</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->kode_invoice }}</td>
                    <td>{{ $transaction->member->nama }}</td>
                    <td>{{ count($transaction->transactionDetail) }}</td>
                    <td>{{ number_format($transaction->subtotal) }}</td>
                    <td>{{ number_format($transaction->biaya_tambahan) }}</td>
                    <td>{{ number_format($transaction->pajak) }}</td>
                    <td>{{ number_format($transaction->diskon) }}</td>
                    <td>{{ number_format($transaction->total) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="text-right" colspan="2">Total</td>
                <td>{{ number_format($summary['total_pesanan']) }}</td>
                <td>{{ number_format($summary['subtotal']) }}</td>
                <td>{{ number_format($summary['biaya_tambahan']) }}</td>
                <td>{{ number_format($summary['pajak']) }}</td>
                <td>{{ number_format($summary['diskon']) }}</td>
                <td>{{ number_format($summary['total']) }}</td>
            </tr>
        </tfoot>
    </table>
@endsection