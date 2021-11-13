<form method="POST" action="{{ route('handleCreateMember')}}">
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
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama" required minlength="3" maxlength="100">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" name="tlp" placeholder="Masukkan nomor telepon" required minlength="10" maxlength="15">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="jenis_kelamin" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <textarea class="form-control" name="alamat" rows="6" placeholder="Masukkan alamat anggota" required minlength="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer modal-footer-bordered">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>