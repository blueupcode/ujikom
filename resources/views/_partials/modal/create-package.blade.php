<form method="POST" action="{{ route('handleCreatePackage') }}">
    @csrf
    <div class="modal fade" id="{{ $modalId }}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $modalTitle }}</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama_paket" placeholder="Masukkan nama paket" required minlength="3" maxlength="100">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="jenis" required>
                            @foreach ([
                                'kiloan' => 'Kiloan',
                                'selimut' => 'Selimut',
                                'bed_cover' => 'Bed Cover',
                                'kaos' => 'Kaos',
                                'lain' => 'Lain',
                            ] as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <input type="number" class="form-control" name="harga" placeholder="Masukkan harga paket" required min="1">
                    </div>
                </div>
                <div class="modal-footer modal-footer-bordered">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>