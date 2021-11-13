@extends('_layouts/dashboard')

@php ($page_title = 'Laporan')

@section('content')
    <form method="GET" action="{{ route('report') }}" class="d-flex mb-3">
        <div class="input-group w-auto">
            <input type="date" class="form-control" name="start" value="{{ $times['start'] }}">
            <input type="date" class="form-control" name="end" value="{{ $times['end'] }}">
            <div class="input-group-append">
                <button class="btn btn-primary">Ubah</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-6">

            <div class="portlet">
                <div class="portlet-header">
                    <div class="portlet-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <h2 class="portlet-title">Daftar transaksi selesai</h2>
                    <div class="portlet-addon">
                        <a href="{{ route('printReportTransaction', ['start' => $times['start'], 'end' => $times['end']]) }}" class="btn btn-label-primary btn-wide">Cetak</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="rich-list rich-list-bordered">
                        @include('_partials.list.transaction', [
                            'transactions' => $transactions
                        ])
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-6">

            <div class="portlet">
                <div class="portlet-header">
                    <div class="portlet-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="portlet-title">Daftar member</div>
                    <div class="portlet-addon">
                        <a href="{{ route('printReportMember', ['start' => $times['start'], 'end' => $times['end']]) }}" class="btn btn-label-primary btn-wide">Cetak</a>
                    </div>
                </div>
                <div class="portlet-body">
                    @include('_partials.list.member', [
                        'members' => $members
                    ])
                </div>
            </div>
            
        </div>
    </div>
@endsection
