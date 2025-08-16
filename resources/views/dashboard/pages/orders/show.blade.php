@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>Detail Pesanan</h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"><a href="{{ route('orders') }}">Pesanan</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Informasi Pesanan</h5>
            <p><strong>Invoice:</strong> {{ $order->number }}</p>
            @php
                $badgeColors = [
                    'belum dibayar' => 'secondary',
                    'sudah dibayar' => 'primary',
                    'dikemas' => 'warning',
                    'dikirim' => 'info',
                    'selesai' => 'success',
                ];
            @endphp

            <p><strong>Status:</strong>
                <span class="badge bg-{{ $badgeColors[$order->status] ?? 'secondary' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Total:</strong> Rp{{ number_format($order->total_payment, 0, ',', '.') }}</p>
            <p><strong>Customer:</strong> {{ $order->user->name ?? '-' }}</p>
            <p><strong>Dibuat:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
            
            <!-- Tampilkan bukti pembayaran jika ada -->
            @if($order->invoice)
            <p>
                <strong>Bukti Pembayaran:</strong>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#paymentProofModal">
                    <i class="fa fa-eye"></i> Lihat Bukti
                </button>
            </p>
            @endif
            
            @if($order->status === 'dikirim' && $order->receipt)
            <p><strong>Nomor Resi:</strong> {{ $order->receipt }}</p>
            @endif

            <hr>
            <h5>Detail Produk</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Ukuran</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->details as $detail)
                    <tr>
                        <td>{{ $detail->product->name ?? 'Produk dihapus' }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>{{ $detail->product->volume . ' ' .  $detail->product->unit}}</td>
                        <td>Rp{{ number_format($detail->price, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Tombol Aksi Berdasarkan Status -->
            @if($order->status === 'sudah dibayar')
            <button class="btn btn-warning mt-2" id="btn-pack-order">
                <i class="fa fa-box"></i> Konfirmasi Dikemas
            </button>
            @endif

            @if($order->status === 'dikemas')
            <button class="btn btn-info mt-2" id="btn-ship-order" data-bs-toggle="modal" data-bs-target="#shippingModal">
                <i class="fa fa-truck"></i> Konfirmasi Dikirim
            </button>
            @endif

            <a href="{{ route('orders') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>
</div>

<!-- Modal untuk input resi pengiriman -->
<div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-labelledby="shippingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shippingModalLabel">Konfirmasi Pengiriman</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="shippingForm" action="{{ route('orders.update', $order->uuid) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="dikirim">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="receipt" class="form-label">Nomor Resi Pengiriman</label>
                        <input type="text" class="form-control" id="receipt" name="receipt" required>
                        <small class="form-text text-muted">Masukkan nomor resi dari jasa pengiriman</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Konfirmasi Pengiriman</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk bukti pembayaran -->
<div class="modal fade" id="paymentProofModal" tabindex="-1" aria-labelledby="paymentProofModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentProofModalLabel">Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/invoices/' . $order->invoice) }}" 
                     alt="Bukti Pembayaran" 
                     class="img-fluid"
                     style="max-height: 70vh;">
                <div class="mt-3">
                    <a href="{{ asset('storage/invoices/' . $order->invoice) }}" 
                       target="_blank" 
                       class="btn btn-primary">
                        <i class="fa fa-download"></i> Download
                    </a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Tambahan styling untuk gambar bukti pembayaran */
    .payment-proof-img {
        max-width: 100%;
        border: 1px solid #eee;
        border-radius: 5px;
        padding: 5px;
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi dikemas
        const btnPack = document.getElementById('btn-pack-order');
        if(btnPack) {
            btnPack.addEventListener('click', function() {
                Swal.fire({
                    title: 'Konfirmasi Pesanan Dikemas?',
                    text: "Apakah Anda yakin ingin mengkonfirmasi pesanan ini sedang dikemas?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Konfirmasi!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim request update status
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = "{{ route('orders.update', $order->uuid) }}";
                        
                        const csrf = document.createElement('input');
                        csrf.type = 'hidden';
                        csrf.name = '_token';
                        csrf.value = "{{ csrf_token() }}";
                        form.appendChild(csrf);
                        
                        const method = document.createElement('input');
                        method.type = 'hidden';
                        method.name = '_method';
                        method.value = 'PUT';
                        form.appendChild(method);
                        
                        const statusInput = document.createElement('input');
                        statusInput.type = 'hidden';
                        statusInput.name = 'status';
                        statusInput.value = 'dikemas';
                        form.appendChild(statusInput);
                        
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        }

        // Validasi form pengiriman
        const shippingForm = document.getElementById('shippingForm');
        if(shippingForm) {
            shippingForm.addEventListener('submit', function(e) {
                const receipt = document.getElementById('receipt').value.trim();
                if(!receipt) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Nomor Resi Kosong',
                        text: 'Harap masukkan nomor resi pengiriman',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
        
        // Fungsi untuk menampilkan gambar bukti pembayaran dalam modal
        const paymentProofModal = new bootstrap.Modal(document.getElementById('paymentProofModal'));
        
        // Jika ada error pada modal, tampilkan secara otomatis
        @if($errors->has('payment_proof'))
            paymentProofModal.show();
        @endif
    });
</script>
@endpush