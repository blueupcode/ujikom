@extends('_layouts/blank')

@php ($page_title = 'Buat Outlet')

@section('content')
    <div class="portlet">
        <div class="portlet-body">
            @error('credential')
                <div class="alert alert-danger justify-content-center">{{ $message }}</div>
            @enderror

            <form method="POST" action="{{ route('handleCreateOutlet') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg @error('nama_outlet') is-invalid @enderror" name="nama_outlet"
                        placeholder="Masukkan nama outlet anda" required minlength="3" maxlength="100">
                    @error('nama_outlet')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="tel" class="form-control form-control-lg @error('tlp') is-invalid @enderror" name="tlp"
                        placeholder="Masukkan nomor telepon outlet anda" required minlength="10" maxlength="15">
                    @error('tlp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <textarea class="form-control form-control-lg @error('tlp') is-invalid @enderror" rows="6" name="alamat" placeholder="Masukkan alamat outlet anda" required minlength="10"></textarea>
                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg @error('nama_user') is-invalid @enderror" name="nama_user"
                        placeholder="Masukkan nama anda" required minlength="3" maxlength="100">
                    @error('nama_user')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" name="username"
                        placeholder="Masukkan username anda" required minlength="3" maxlength="30">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                        placeholder="Masukkan password anda" required minlength="8">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-block btn-lg btn-primary">Buat baru</button>
            </form>
            
        </div>
    </div>
@endsection
