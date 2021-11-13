<form method="POST" action="{{ route('handleUpdateUser', ['user' => $userId])}}">
    @csrf
    <input type="hidden" name="role" value="{{ $role }}">
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
                    <div class="form-group">
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama" value="{{ $inputs['nama'] }}" required minlength="3" maxlength="100">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Masukkan username" value="{{ $inputs['username'] }}" required min="3" maxlength="30">
                    </div>
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" name="password" placeholder="Buat password baru" minlength="8">
                    </div>
                </div>
                <div class="modal-footer modal-footer-bordered">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>