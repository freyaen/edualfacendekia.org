@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')
<div class="checkout_area mt-100">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8">
                <div class="checkout_form">
                    <h4>{{ LanguageController::t('Detail Pengiriman') }}</h4>
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>{{ LanguageController::t('Nama Lengkap') }}</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>{{ LanguageController::t('Email') }}</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>{{ LanguageController::t('No Hp') }}</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->phone }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>{{ LanguageController::t('Alamat Lengkap') }}</label>
                            <textarea class="form-control" rows="3" readonly>{{ Auth::user()->address }}</textarea>
                        </div>
                        
                        <!-- Tambahkan input tersembunyi untuk item yang dipilih -->
                        @foreach($selectedItems as $item)
                        <input type="hidden" name="selected_items[]" value="{{ $item }}">
                        @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="order_summary">
                    <h4>{{ LanguageController::t('Ringkasan Pesanan') }}</h4>
                    
                    @foreach($stores as $storeId => $items)
                    <div class="store-summary mb-4">
                        <h5>{{ $items->first()->product->store->name }}</h5>
                        
                        <div class="summary_content">
                            <div class="summary_item">
                                <span>{{ LanguageController::t('Subtotal') }}</span>
                                <span>Rp{{ number_format($items->sum(function($item) {
                                    return $item->product->price * $item->qty;
                                }), 0, ',', '.') }}</span>
                            </div>

                            <div class="summary_item">
                                <span>{{ LanguageController::t('Ongkos Kirim') }}</span>
                                <span>Rp10.000</span>
                            </div>

                            <div class="summary_item total">
                                <span>{{ LanguageController::t('Total') }}</span>
                                <span>Rp{{ number_format($items->sum(function($item) {
                                    return $item->product->price * $item->qty;
                                }) + 10000, 0, ',', '.') }}</span>
                            </div>

                            <hr>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="summary_content">
                        <div class="summary_item grand-total">
                            <span>{{ LanguageController::t('Total Keseluruhan') }}</span>
                            <span>Rp{{ number_format(
                                $stores->sum(function($items) {
                                    return $items->sum(function($item) {
                                        return $item->product->price * $item->qty;
                                    }) + 10000;
                                }), 
                                0, ',', '.') 
                            }}</span>
                        </div>

                        <button type="submit" class="button p-0 w-100 mt-3">{{ LanguageController::t('Buat Pesanan') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .store-summary {
        border: 1px solid #eee;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    
    .store-summary h5 {
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }
    
    .grand-total {
        font-size: 1.2rem;
        font-weight: bold;
        padding-top: 10px;
        border-top: 2px solid #eee;
    }
</style>
@endpush