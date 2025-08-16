@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')
<div class="orders_area mt-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section_title">
                    <h2>{{ LanguageController::t('Daftar Pesanan Anda') }}</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                @if($orders->isEmpty())
                    <div class="alert alert-info text-center">
                        <i class="fas fa-shopping-bag fa-3x mb-3"></i>
                        <h4>{{ LanguageController::t('Anda belum memiliki pesanan') }}</h4>
                        <a href="{{ route('index') }}" class="btn btn-dark mt-3">{{ LanguageController::t('Mulai Belanja') }}</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th>{{ LanguageController::t('No. Pesanan') }}</th>
                                    <th>{{ LanguageController::t('Tanggal') }}</th>
                                    <th>{{ LanguageController::t('Items') }}</th>
                                    <th>{{ LanguageController::t('Total') }}</th>
                                    <th>{{ LanguageController::t('Status') }}</th>
                                    <th>{{ LanguageController::t('Aksi') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->number }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>{{ $order->details->sum('qty') }} {{ LanguageController::t('item(s)') }}</td>
                                    <td>Rp{{ number_format($order->total_payment, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($order->status == 'belum dibayar') bg-warning
                                            @elseif($order->status == 'sudah dibayar') bg-info
                                            @elseif($order->status == 'dikemas') bg-dark
                                            @elseif($order->status == 'dikirim') bg-success
                                            @else bg-secondary @endif">
                                            {{ LanguageController::t(ucfirst(str_replace('_', ' ', $order->status))) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.list.detail', $order->uuid) }}" class="btn btn-sm btn-dark text-light">
                                            <i class="icon-eye"></i> {{ LanguageController::t('Detail') }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection