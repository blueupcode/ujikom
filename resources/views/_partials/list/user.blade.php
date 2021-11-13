<div class="rich-list rich-list-bordered">
    @forelse ($users as $user)
        <div class="rich-list-item">
            <div class="rich-list-content">
                <h3 class="rich-list-title">{{ $user->nama }}</h3>
                <p class="rich-list-subtitle">{{ $user->username }}</p>
            </div>
            <div class="rich-list-append">
                <button
                    class="btn btn-label-info btn-wide"
                    data-toggle="modal"
                    data-target="#update-{{ $type }}-{{ $user->id }}"
                >
                    Ubah
                </button>
                @if ($user->id != Auth::user()->id)
                    <a
                        href="{{ route('handleDeleteUser', ['user' => $user->id]) }}"
                        onclick="return confirm('Yakin ingin menghapus {{ $user->nama }} ?')"
                        class="btn btn-label-danger btn-wide ml-2"
                    >
                        Hapus
                    </a>
                @endif
            </div>
            @include('_partials.modal.update-user', [
                'role' => $type,
                'modalId' => 'update-'.$type.'-'.$user->id,
                'modalTitle' => 'Ubah data kasir',
                'userId' => $user->id,
                'inputs' => [
                    'nama' => $user->nama,
                    'username' => $user->username,
                ],
            ])
        </div>
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>
