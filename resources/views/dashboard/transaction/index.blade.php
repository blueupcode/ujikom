@extends('_layouts/dashboard')

@php ($page_title = 'Transaksi')

@section('content')
    <div class="row">
        <div class="col-md-4">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="portlet">
                <div class="portlet-header">
                    <div class="portlet-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <h2 class="portlet-title">Daftar anggota</h2>
                    <div class="portlet-addon">
                        <button class="btn btn-label-success btn-wide" data-toggle="modal" data-target="#create-member">Buat
                            baru
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    <form method="GET">
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" name="member_search" placeholder="Cari member"
                                value="{{ request()->get('member_search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary btn-wide">Cari</button>
                            </div>
                        </div>
                    </form>
                    @include('_partials.list.member', [
                        'members' => $members
                    ])
                </div>
            </div>

        </div>
        <div class="col-md-8">

            <div class="portlet">
                <div class="portlet-header">
                    <div class="portlet-icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <h2 class="portlet-title">Daftar transaksi</h2>
                </div>
                <div class="portlet-body">
                    <div class="rich-list rich-list-bordered">
                        @include('_partials.list.transaction', [
                            'transactions' => $transactions
                        ])
                    </div>
                </div>
                @if ($transactions->hasPages())
                    <div class="portlet-footer">
                        {{ $transactions->links() }}
                    </div>
                @endif
            </div>
            
        </div>
    </div>
@endsection

@section('modal')
    @include('_partials.modal.create-member', [
        'modalId' => 'create-member',
        'modalTitle' => 'Buat anggota baru',
    ])
@endsection
