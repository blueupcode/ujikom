<div class="rich-list rich-list-bordered">
    @forelse ($members as $member)
        <div class="rich-list-item">
            <div class="rich-list-content">
                <h3 class="rich-list-title">
                    {{ $member->nama }}
                    <span class="badge badge-info">{{ $member->jenis_kelamin }}</span>
                </h3>
                <span class="rich-list-subtitle">{{ $member->tlp }}</span>
                <p class="rich-list-subtitle">{{ $member->alamat }}</p>
            </div>
            <div class="rich-list-append">
                <a href="{{ route('handleCreateTransaction', ['member' => $member->id]) }}" class="btn btn-label-info btn-wide">Buat pesanan</a>
            </div>
        </div>
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>