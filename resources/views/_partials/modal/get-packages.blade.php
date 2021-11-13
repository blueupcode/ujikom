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
                <div class="rich-list rich-list-bordered">
                    @foreach ($packages as $package)
                        <div class="rich-list-item">
                            <div class="rich-list-content">
                                <h3 class="rich-list-title">{{ $package->nama_paket }} </h3>
                                <div class="rich-list-subtitle">
                                    {{ $package->harga }}
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
                                <form method="POST" action="{{ route('handleCreateTransactionDetail', ['transaction' => $transaction->id]) }}">
                                    @csrf
                                    <input type="hidden" name="id_paket" value="{{ $package->id }}">
                                    <button type="submit" class="btn btn-label-primary">Pilih</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>