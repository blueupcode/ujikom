@extends('_layouts/dashboard')

@php ($page_title = 'Detail transaksi')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">

            <div class="portlet">
                <div class="portlet-header">
                    <h2 class="portlet-title">Daftar pesanan</h2>
                    @if ($transaction->dibayar === 'belum_dibayar')
                        <div class="portlet-addon">
                            <button class="btn btn-label-success btn-wide" data-toggle="modal" data-target="#create-transaction-detail">
                                Tambah
                            </button>
                        </div>
                    @endif
                </div>
                <div class="portlet-body">
                    @include('_partials.list.transaction-detail', [
                        'transactionDetail' => $transactionDetail
                    ])
                </div>
            </div>

        </div>
        <div class="col-md-4">
            @if ($transaction->status !== 'diambil')
                <div class="form-group">
                    <a href="{{ route('handleProcessTransaction', [ 'transaction' => $transaction->id ]) }}" class="btn btn-info btn-block btn-lg">{{ ucfirst($transaction->status_new) }}</a>
                </div>
            @endif

            <div class="portlet">
                <div class="portlet-header portlet-header-bordered">
                    <h2 class="portlet-title">Invoice: {{ $transaction->kode_invoice }}</h2>
                </div>
                <div class="portlet-body">
                    <form method="POST" action="{{ route('handleUpdateInvoiceTransaction', [ 'transaction' => $transaction->id ]) }}">
                        @csrf
                        <div class="rich-list-item mb-4">
                            <div class="rich-list-content">
                                <h3 class="rich-list-title">{{ $member->nama }} <div class="badge badge-info">
                                        {{ $member->jenis_kelamin }}</div>
                                </h3>
                                <span class="rich-list-subtitle">{{ $member->tlp }}</span>
                                <p class="rich-list-subtitle">{{ $member->alamat }}</p>
                            </div>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>{{ number_format($transaction->subtotal) }}</td>
                                </tr>
                                <tr>
                                    <td>Pajak</td>
                                    <td>
                                        @if ($transaction->dibayar === 'belum_dibayar')
                                            <input type="number" class="form-control" placeholder="Masukkan jumlah pajak" name="pajak" value="{{ $transaction->pajak }}">
                                        @else
                                            {{ number_format($transaction->pajak) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Biaya tambahan</td>
                                    <td>
                                        @if ($transaction->dibayar === 'belum_dibayar')
                                            <input type="number" class="form-control" placeholder="Masukkan jumlah biaya tambahan" name="biaya_tambahan" value="{{ $transaction->biaya_tambahan }}">
                                        @else
                                            {{ number_format($transaction->biaya_tambahan) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Diskon</td>
                                    <td>
                                        @if ($transaction->dibayar === 'belum_dibayar')
                                            <input type="number" class="form-control" placeholder="Masukkan jumlah diskon" name="diskon" value="{{ $transaction->diskon }}">
                                        @else
                                            {{ number_format($transaction->diskon) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>{{ number_format($transaction->total) }}</td>
                                </tr>
                                <tr>
                                    <td>Dibuat pada</td>
                                    <td>{{ $transaction->tgl }}</td>
                                </tr>
                                <tr>
                                    <td>Batas waktu</td>
                                    <td>
                                        @if ($transaction->dibayar === 'belum_dibayar')
                                            <input type="datetime-local" class="form-control" placeholder="Masukkan batas waktu" name="batas_waktu" value="{{ $transaction->batas_waktu_formated }}">
                                        @else
                                            {{ $transaction->batas_waktu }}
                                        @endif
                                    </td>
                                </tr>
                                @if ($transaction->dibayar === 'dibayar')
                                    <tr>
                                        <td>Tanggal dibayar</td>
                                        <td>{{ $transaction->tgl_bayar }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        @if ($transaction->dibayar === 'belum_dibayar')
                            <button type="submit" class="btn btn-label-primary btn-lg btn-block">Ubah</button>
                        @endif
                    </form>
                    @if ($transaction->dibayar === 'belum_dibayar')
                        <a onclick="return confirm('Apakah anda ingin membayar transaksi ini?')" href="{{ route('handlePaymentTransaction', [ 'transaction' => $transaction->id ]) }}" class="btn btn-label-info btn-lg btn-block mt-3">Bayar</a>
                    @endif
                </div>
            </div>

            @if (Auth::user()->role !== 'owner')
                <div class="form-group">
                    <a href="{{ route('handleDeleteTransaction', [ 'transaction' => $transaction->id ]) }}" class="btn btn-label-danger btn-lg btn-block">Hapus transaksi</a>
                </div>
            @endif

        </div>
    </div>
@endsection

@section('modal')
    @include('_partials.modal.get-packages', [
        'modalId' => 'create-transaction-detail',
        'modalTitle' => 'Pilih paket',
    ])
@endsection
