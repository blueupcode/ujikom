<div class="rich-list rich-list-bordered">
    @forelse ($packages as $package)
        <div class="rich-list-item">
            <div class="rich-list-content">
                <h3 class="rich-list-title">{{ $package->nama_paket }} </h3>
                <div class="rich-list-subtitle">
                    {{ number_format($package->harga) }}
                    <span class="badge badge-primary ml-1">
                        {{
                            [
                                'kiloan' => 'Kiloan',
                                'selimut' => 'Selimut',
                                'bed_cover' => 'Bed Cover',
                                'kaos' => 'Kaos',
                                'lain' => 'Lain',
                            ][$package->jenis]
                        }}
                    </span>
                </div>
            </div>
            <div class="rich-list-append">
                <button class="btn btn-label-info btn-wide" data-toggle="modal" data-target="#update-package-{{ $package->id }}">Ubah</button>
                <a
                    href="{{ route('handleDeletePackage', ['package' => $package->id]) }}"
                    onclick="return confirm('Yakin ingin menghapus {{ $package->nama_paket }} ?')"
                    class="btn btn-label-danger btn-wide ml-2"
                >
                    Hapus
                </a>
            </div>
            @include('_partials.modal.update-package', [
                'modalId' => 'update-package-'.$package->id,
                'modalTitle' => 'Ubah data paket',
                'packageId' => $package->id,
                'inputs' => [
                    'nama_paket' => $package->nama_paket,
                    'jenis' => $package->jenis,
                    'harga' => $package->harga,
                ],
            ])
        </div>
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>
