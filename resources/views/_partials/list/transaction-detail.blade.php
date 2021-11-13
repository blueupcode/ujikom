<div class="rich-list rich-list-bordered">
    @forelse ($transactionDetail as $transactionDetailItem)
        @if ($transaction->dibayar === 'belum_dibayar')
            <form method="POST" action="{{ route('handleUpdateTransactionDetail', ['transactionDetail' => $transactionDetailItem->id]) }}"
                class="p-3 border rounded mb-3">
                @csrf
                <input type="hidden" name="id" value="{{ $transactionDetailItem->id }}">
                <div class="rich-list-item border-0 p-0">
                    <div class="rich-list-content">
                        <h3 class="rich-list-title">{{ $transactionDetailItem->package->nama_paket }}</h3>
                        <div class="rich-list-subtitle">
                            {{ number_format($transactionDetailItem->package->harga) }}
                            <span class="badge badge-primary ml-1">
                                {{
                                    [
                                        'kiloan' => 'Kiloan',
                                        'selimut' => 'Selimut',
                                        'bed_cover' => 'Bed Cover',
                                        'kaos' => 'Kaos',
                                        'lain' => 'Lain',
                                    ][$transactionDetailItem->package->jenis]
                                }}
                            </span>
                        </div>
                    </div>
                    <div class="rich-list-append">
                        <input type="number" class="form-control" style="max-width: 5rem" name="qty" value="{{ $transactionDetailItem->qty }}" required min="1">
                    </div>
                </div>
                <div class="form-group mt-3">
                    <textarea class="form-control" placeholder="Tambahkan keterangan" rows="3" name="keterangan">{{ $transactionDetailItem->keterangan }}</textarea>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-label-primary btn-wide">Ubah</button>
                    <a href="{{ route('handleDeleteTransactionDetail', ['transactionDetail' => $transactionDetailItem->id]) }}" class="btn btn-label-danger btn-wide ml-2">
                        Hapus
                    </a>
                </div>
            </form>
        @else
            <div class="rich-list-item">
                <div class="rich-list-content">
                    <h3 class="rich-list-title">{{ $transactionDetailItem->package->nama_paket }}</h3>
                    <div class="rich-list-subtitle">
                        {{ number_format($transactionDetailItem->package->harga) }}
                        <span class="badge badge-primary ml-1">
                            {{
                                [
                                    'kiloan' => 'Kiloan',
                                    'selimut' => 'Selimut',
                                    'bed_cover' => 'Bed Cover',
                                    'kaos' => 'Kaos',
                                    'lain' => 'Lain',
                                ][$transactionDetailItem->package->jenis]
                            }}
                        </span>
                    </div>
                    <p class="rich-list-paragraph">{{ $transactionDetailItem->keterangan }}</p>
                </div>
                <div class="rich-list-append">
                    <span class="badge badge-xl badge-primary">{{ $transactionDetailItem->qty }}</span>
                </div>
            </div>
        @endif
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>