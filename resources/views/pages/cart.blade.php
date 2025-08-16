@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')
<!--shopping cart area start -->
<div class="shopping_cart_area mt-100">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($cart && $cart->details->count() > 0)
        <form action="{{ route('checkout') }}" method="GET" id="checkout-form">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="cart_page table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product_select">{{ LanguageController::t('Pilih') }}</th>
                                        <th class="product_remove">{{ LanguageController::t('Hapus') }}</th>
                                        <th class="product_thumb">{{ LanguageController::t('Gambar') }}</th>
                                        <th class="product_name">{{ LanguageController::t('Produk') }}</th>
                                        <th class="product-price">{{ LanguageController::t('Harga') }}</th>
                                        <th class="product_quantity">{{ LanguageController::t('Jumlah') }}</th>
                                        <th class="product_total">{{ LanguageController::t('Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->details as $item)
                                    <tr>
                                        <td class="product_select">
                                            <input type="checkbox" name="selected_items[]" 
                                                value="{{ $item->uuid }}" 
                                                class="item-checkbox" 
                                                checked
                                                data-price="{{ $item->product->price }}"
                                                data-qty="{{ $item->qty }}">
                                        </td>
                                        <td class="product_remove">
                                            <button type="button" class="btn-remove" data-uuid="{{ $item->uuid }}"
                                                style="background: none; border: none; cursor: pointer;">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                        <td class="product_thumb">
                                            <img src="{{ asset('storage/products/' . $item->product->images[0]->name) }}"
                                                alt="{{ $item->product->name }}" style="width: 80px;">
                                        </td>
                                        <td class="product_name">
                                            {{ $item->product->name }}
                                        </td>
                                        <td class="product-price">
                                            Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                                        <td class="product_quantity">
                                            <input type="number" class="qty-input" data-uuid="{{ $item->uuid }}" min="1"
                                                max="100" value="{{ $item->qty }}">
                                        </td>
                                        <td class="product_total item-total" data-uuid="{{ $item->uuid }}">
                                            Rp{{ number_format($item->product->price * $item->qty, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-select-actions my-3 mx-3">
                            <button type="button" class="btn btn-dark" id="select-all">
                                {{ LanguageController::t('Pilih Semua') }}
                            </button>
                            <button type="button" class="btn btn-dark" id="deselect-all">
                                {{ LanguageController::t('Batalkan Semua') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--coupon code area start-->
            <div class="coupon_area">
                <div class="coupon_code right">
                    <h3>{{ LanguageController::t('Total Belanja') }}</h3>
                    <div class="coupon_inner">
                        <div class="cart_subtotal">
                            <p>{{ LanguageController::t('Subtotal') }}</p>
                            <p class="cart_amount" id="subtotal-display">
                                Rp{{ number_format($cart->details->sum(function($item) {
                                    return $item->product->price * $item->qty;
                                }), 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="cart_subtotal">
                            <p>{{ LanguageController::t('Ongkos Kirim') }}</p>
                            <p class="cart_amount">Rp10.000</p>
                        </div>

                        <div class="cart_subtotal">
                            <p>{{ LanguageController::t('Total') }}</p>
                            <p class="cart_amount" id="total-display">
                                Rp{{ number_format($cart->details->sum(function($item) {
                                    return $item->product->price * $item->qty;
                                }) + 10000, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="checkout_btn">
                            <button type="submit" class="btn btn-primary" id="checkout-button">
                                {{ LanguageController::t('Lanjut ke Pembayaran') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!--coupon code area end-->
        </form>
        @else
        <div class="row mb-5">
            <div class="col-12">
                <div class="text-center">
                    <i class="fa fa-shopping-cart fa-3x mb-3"></i>
                    <h4>{{ LanguageController::t('Keranjang belanja Anda kosong') }}</h4>
                    <p>{{ LanguageController::t('Silahkan tambahkan produk ke keranjang belanja Anda') }}</p>
                    <a href="{{ route('index') }}" class="button">{{ LanguageController::t('Lanjut Belanja') }}</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<!--shopping cart area end -->
@endsection

@push('styles')
<style>
    .product_select {
        width: 5%;
        text-align: center;
    }
    .cart-select-actions {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fungsi untuk menghitung ulang total belanja
        function calculateTotals() {
            let subtotal = 0;
            
            // Iterasi semua checkbox yang dicentang
            document.querySelectorAll('.item-checkbox:checked').forEach(checkbox => {
                const price = parseFloat(checkbox.dataset.price);
                const qty = parseInt(checkbox.dataset.qty);
                subtotal += price * qty;
            });
            
            const shipping = 10000;
            const total = subtotal + shipping;
            
            // Update tampilan
            document.getElementById('subtotal-display').textContent = formatCurrency(subtotal);
            document.getElementById('total-display').textContent = formatCurrency(total);
            
            // Update status tombol checkout
            document.getElementById('checkout-button').disabled = subtotal === 0;
        }
        
        // Format angka ke format mata uang
        function formatCurrency(amount) {
            return 'Rp' + amount.toLocaleString('id-ID');
        }
        
        // Event listener untuk checkbox
        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotals);
        });
        
        // Event listener untuk tombol pilih semua
        document.getElementById('select-all').addEventListener('click', function() {
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                checkbox.checked = true;
            });
            calculateTotals();
        });
        
        // Event listener untuk tombol batal semua
        document.getElementById('deselect-all').addEventListener('click', function() {
            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                checkbox.checked = false;
            });
            calculateTotals();
        });
        
        // Event listener untuk penghapusan item
        document.querySelectorAll('.btn-remove').forEach(function (button) {
            button.addEventListener('click', function () {
                const uuid = this.getAttribute('data-uuid');
                
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/cart/remove/${uuid}`;
                
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                form.appendChild(csrf);
                
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);
                
                document.body.appendChild(form);
                form.submit();
            });
        });
        
        // Event listener untuk perubahan jumlah
        document.querySelectorAll('.qty-input').forEach(function (input) {
            input.addEventListener('change', function () {
                const uuid = this.getAttribute('data-uuid');
                const qty = this.value;
                
                // Update data-qty di checkbox terkait
                const checkbox = document.querySelector(`.item-checkbox[value="${uuid}"]`);
                if (checkbox) {
                    checkbox.dataset.qty = qty;
                }
                
                // Update total per item
                const price = parseFloat(checkbox.dataset.price);
                const itemTotal = document.querySelector(`.item-total[data-uuid="${uuid}"]`);
                if (itemTotal) {
                    itemTotal.textContent = formatCurrency(price * qty);
                }
                
                // Hitung ulang total keseluruhan
                calculateTotals();
                
                // Kirim update ke server
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/cart/update/${uuid}`;
                
                form.innerHTML = `
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="qty" value="${qty}">
                `;
                
                document.body.appendChild(form);
                form.submit();
            });
        });
        
        // Hitung total awal
        calculateTotals();
    });
</script>
@endpush