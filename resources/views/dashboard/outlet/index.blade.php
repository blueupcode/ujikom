@extends('_layouts/dashboard')

@php ($page_title = 'Konfigurasi Outlet')

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
                    <div class="portlet-icon">
                        <i class="fa fa-boxes"></i>
                    </div>
                    <h2 class="portlet-title">Daftar paket produk</h2>
                    <div class="portlet-addon">
                        <button class="btn btn-label-success btn-wide" data-toggle="modal" data-target="#create-package">
                            Buat baru
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    @include('_partials.list.package', [
                        'packages' => $packages,
                    ])
                </div>
            </div>

            <div class="portlet">
                <div class="portlet-header">
                    <div class="portlet-icon">
                        <i class="fa fa-user-tag"></i>
                    </div>
                    <h2 class="portlet-title">Daftar kasir</h2>
                    <div class="portlet-addon">
                        <button class="btn btn-label-success btn-wide" data-toggle="modal" data-target="#create-casier">
                            Buat baru
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    @include('_partials.list.user', [
                        'users' => $casiers,
                        'type' => 'casier'
                    ])
                </div>
            </div>

            <div class="portlet">
                <div class="portlet-header">
                    <div class="portlet-icon">
                        <i class="fa fa-user-shield"></i>
                    </div>
                    <h2 class="portlet-title">Daftar owner</h2>
                    <div class="portlet-addon">
                        <button class="btn btn-label-success btn-wide" data-toggle="modal" data-target="#create-owner">
                            Buat baru
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    @include('_partials.list.user', [
                        'users' => $owners,
                        'type' => 'owner'
                    ])
                </div>
            </div>

            <div class="portlet">
                <div class="portlet-header">
                    <div class="portlet-icon">
                        <i class="fa fa-user-cog"></i>
                    </div>
                    <h2 class="portlet-title">Daftar admin</h2>
                    <div class="portlet-addon">
                        <button class="btn btn-label-success btn-wide" data-toggle="modal" data-target="#create-admin">
                            Buat baru
                        </button>
                    </div>
                </div>
                <div class="portlet-body">
                    @include('_partials.list.user', [
                        'users' => $admins,
                        'type' => 'admin'
                    ])
                </div>
            </div>

        </div>
        <div class="col-md-4">

            <div class="portlet">
                <div class="portlet-header">
                    <div class="portlet-icon">
                        <i class="fa fa-store"></i>
                    </div>
                    <h2 class="portlet-title">Informasi outlet</h2>
                </div>
                <div class="portlet-body">

                    <form method="POST" action="{{ route('handleUpdateOutlet') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control" value="{{ $outlet->nama }}" placeholder="Masukkan nama outlet" required minlength="3" maxlength="100">
                        </div>
                        <div class="form-group">
                            <input type="text" name="tlp" class="form-control" value="{{ $outlet->tlp }}" placeholder="Masukkan nomor telpon outlet" required minlength="10" maxlength="15">
                        </div>
                        <div class="form-group">
                            <textarea name="alamat" class="form-control" placeholder="Masukkan alamat outlet" cols="30" rows="6" required minlength="10">{{ $outlet->alamat }}</textarea>
                        </div>
                        <button class="btn btn-primary btn-block">Simpan</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection

@section('modal')
    @include('_partials.modal.create-package', [
        'modalId' => 'create-package',
        'modalTitle' => 'Buat paket baru',
    ])
    @include('_partials.modal.create-user', [
        'role' => 'kasir',
        'modalId' => 'create-casier',
        'modalTitle' => 'Buat kasir baru',
    ])
    @include('_partials.modal.create-user', [
        'role' => 'owner',
        'modalId' => 'create-owner',
        'modalTitle' => 'Buat owner baru',
    ])
    @include('_partials.modal.create-user', [
        'role' => 'admin',
        'modalId' => 'create-admin',
        'modalTitle' => 'Buat admin baru',
    ])
@endsection
