@extends('_layouts.print')

@php ($page_title = 'Laporan Anggota '.$times['start'].' sampai '.$times['end'])

@section('content')
    <h1 class="text-center mb-5">Laporan Anggota {{ $times['start'] }} sampai {{ $times['end'] }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td>Nama</td>
                <td>Nomor Telepon</td>
                <td>Jenis Kelamin</td>
                <td>Alamat</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->tlp }}</td>
                    <td>{{ $member->jenis_kelamin }}</td>
                    <td>{{ $member->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection