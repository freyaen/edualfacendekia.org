@extends('layouts.app')

@section('content')
<div class="order_detail_area mt-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="order_detail_card">
                    <!-- Header -->
                    <div class="order_header text-center mb-4">
                        <h2 class="mb-3"><i class="fas fa-receipt"></i> Detail Pesanan</h2>
                        <div class="order_meta">
                            <span class="order_number badge bg-dark">#{{ $order->number }}</span>
                            <span class="order_date">Tanggal: {{ $order->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="order_status mb-4">
                        <div class="status_badge text-center">
                            <span class="badge 
                                @if($order->status == 'belum dibayar') bg-warning
                                @elseif($order->status == 'sudah dibayar') bg-info
                                @elseif($order->status == 'dikemas') bg-dark
                                @elseif($order->status == 'dikirim') bg-success
                                @else bg-secondary @endif">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                    </div>

                     @if($order->status == 'dikirim' && $order->receipt)
                    <div class="shipping_info mb-4">
                        <h4 class="section_title"> Informasi Pengiriman</h4>
                        <div class="alert alert-info">
                            <p><strong>Nomor Resi:</strong> {{ $order->receipt }}</p>
                            <p>Anda dapat melacak status pengiriman pesanan Anda dengan nomor resi di atas melalui website jasa pengiriman:</p>
                            <div class="tracking_links">
                                <a href="https://www.jne.co.id" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> JNE
                                </a>
                                <a href="https://www.tiki.id" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> TIKI
                                </a>
                                <a href="https://www.sicepat.com" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> SiCepat
                                </a>
                                <a href="https://www.jet.co.id" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> J&T Express
                                </a>
                                <a href="https://www.anteraja.id" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> AnterAja
                                </a>
                            </div>
                        </div>
                        
                        @if($order->status === 'dikirim')
                        <div class="text-center mt-3">
                            <button class="btn btn-success" id="btn-complete-order">
                                Konfirmasi Pesanan Sampai
                            </button>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Items -->
                    <div class="order_items mb-4">
                        <h4 class="section_title"><i class="fas fa-box-open"></i> Daftar Produk</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->details as $item)
                                    <tr>
                                        <td>
                                            <div class="product_info">
                                                <img src="{{ asset('storage/products/'.$item->product->images[0]->name) }}"
                                                    alt="{{ $item->product->name }}" width="50">
                                                <span>{{ $item->product->name }}</span>
                                            </div>
                                        </td>
                                        <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div class="order_summary mb-4">
                        <h4 class="section_title"><i class="fas fa-receipt"></i> Ringkasan Pembayaran</h4>
                        <div class="summary_content">
                            <div class="summary_item">
                                <span>Subtotal</span>
                                <span>Rp{{ number_format($order->details->sum('subtotal'), 0, ',', '.') }}</span>
                            </div>
                            <div class="summary_item">
                                <span>Ongkos Kirim</span>
                                <span>Rp10.000</span>
                            </div>
                            <div class="summary_item total">
                                <span>Total Pembayaran</span>
                                <span>Rp{{ number_format($order->total_payment, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="payment_section mb-4">
                        <h4 class="section_title">Pembayaran</h4>

                        @if($order->status == 'belum dibayar')
                        <div class="payment_instructions mb-4">
                            <div class="alert alert-info">
                                Instruksi Pembayaran</h5>
                                <p>Silakan transfer pembayaran ke:</p>
                                <div class="bank_details">
                                    <p><strong>Bank:</strong> BCA</p>
                                    <p><strong>Nomor Rekening:</strong> 7625112753</p>
                                    <p><strong>Atas Nama:</strong> Freya Enggaryni</p>
                                    <p><strong>Jumlah:</strong>
                                        Rp{{ number_format($order->total_payment, 0, ',', '.') }}</p>
                                </div>
                                <p class="mt-2">Setelah transfer, upload bukti pembayaran di bawah ini:</p>
                            </div>
                        </div>

                        <div class="payment_upload">
                            <form action="{{ route('orders.list.upload', $order->uuid) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="invoice" class="form-label">Upload Bukti Pembayaran</label>
                                    <input type="file" class="form-control" id="invoice" name="invoice" required
                                        accept="image/*,.pdf,.doc,.docx">
                                    <div class="form-text">Format: JPG, PNG, PDF (Maks. 2MB)</div>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">
                                    Upload Bukti Pembayaran
                                </button>
                            </form>
                        </div>
                         @if($order->status == 'dikirim' && $order->receipt)
                    <div class="shipping_info mb-4">
                        <h4 class="section_title"> Informasi Pengiriman</h4>
                        <div class="alert alert-info">
                            <p><strong>Nomor Resi:</strong> {{ $order->receipt }}</p>
                            <p>Anda dapat melacak status pengiriman pesanan Anda dengan nomor resi di atas melalui website jasa pengiriman:</p>
                            <div class="tracking_links">
                                <a href="https://www.jne.co.id" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> JNE
                                </a>
                                <a href="https://www.tiki.id" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> TIKI
                                </a>
                                <a href="https://www.sicepat.com" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> SiCepat
                                </a>
                                <a href="https://www.jet.co.id" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> J&T Express
                                </a>
                                <a href="https://www.anteraja.id" target="_blank" class="btn btn-sm btn-outline-dark mb-1">
                                    <i class="fas fa-external-link-alt"></i> AnterAja
                                </a>
                            </div>
                        </div>
                        
                        @if($order->status === 'dikirim')
                        <div class="text-center mt-3">
                            <button class="btn btn-success" id="btn-complete-order">
                                Konfirmasi Pesanan Sampai
                            </button>
                        </div>
                        @endif
                    </div>
                    @endif
                        @elseif($order->invoice)
                        <div class="payment_confirmation">
                            <div class="alert alert-success">
                                <h5> Pembayaran Terkonfirmasi</h5>
                                <p>Bukti pembayaran sudah diupload pada:
                                    {{ $order->updated_at->format('d M Y H:i') }}</p>

                                <div class="invoice_preview mt-3">
                                    <a href="{{ asset('storage/invoices/'.$order->invoice) }}" target="_blank"
                                        class="btn btn-outline-dark">
                                        <i class="fas fa-file-invoice"></i> Lihat Bukti Pembayaran
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="order_actions text-center mb-5">
                        <a href="{{ route('orders.list') }}" class="btn btn-outline-secondary me-2">
                            Kembali ke Daftar Pesanan
                        </a>
                        <a href="{{ route('index') }}" class="btn btn-dark">
                            Kembali ke belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi pesanan sampai
        const btnComplete = document.getElementById('btn-complete-order');
        if(btnComplete) {
            btnComplete.addEventListener('click', function() {
                Swal.fire({
                    title: 'Konfirmasi Pesanan Sampai?',
                    text: "Apakah pesanan Anda sudah diterima dengan baik?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Pesanan Sudah Sampai',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim request update status
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = "{{ route('orders.list.complete', $order->uuid) }}";
                        
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
                        
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        }
    });
</script>
@endpush