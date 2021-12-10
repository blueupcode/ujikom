@extends('_layouts/blank')

@php ($page_title = 'Login')

@section('content')
    <div class="portlet">
        <div class="portlet-body">
            @error('credential')
                <div class="alert alert-danger justify-content-center">{{ $message }}</div>
            @enderror

            <form method="POST" action="{{ route('handleLogin') }}">
                @csrf
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
                    <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                        placeholder="Masukkan password anda" required minlength="8">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-block btn-lg btn-primary">Masuk</button>
            </form>
            
        </div>
    </div>
@endsection
