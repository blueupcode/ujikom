<div class="rich-list rich-list-bordered">
    @forelse ($transactions as $transaction)
        <div class="rich-list-item">
            <div class="rich-list-content">
                <h5 class="rich-list-title">{{ $transaction->member->nama }}</h5>
                <span class="rich-list-subtitle">
                    {{ number_format($transaction->total) }} -
                    {{ count($transaction->transactionDetail) }} Pesanan
                    <span class="badge badge-primary">{{ $transaction->status }}</span>
                </span>
                <span class="rich-list-subtitle">{{ $transaction->created_at }}</span>
            </div>
            <div class="rich-list-append">
                <a href="{{ route('transactionDetail', ['invoiceCode' => $transaction->kode_invoice]) }}" class="btn btn-label-info btn-wide">Detail</a>
            </div>
        </div>
    @empty
        <div class="alert alert-danger justify-content-center mb-0">Tidak ada data</div>
    @endforelse
</div>