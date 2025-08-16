@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>Pesanan</h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Pesanan</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row size-column">
        <div class="col-xxl-9 box-col-12">
            <div class="card recent-order">
                <div class="card-body">
                    <h4 class="mb-3">Daftar Pesanan</h4>
                    <div class="project-table table-responsive custom-scrollbar">
                        <table class="order-table project-table w-100 mb-3">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Status</th>
                                    <th>Total Pembayaran</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data['orders'] as $order)
                                <tr>
                                    <td>{{ $order->number }}</td>
                                    <td>{{ $order->user->name ?? '-' }}</td>
                                    <td>
                                        @php
                                        $badgeColors = [
                                        'belum dibayar' => 'secondary',
                                        'sudah dibayar' => 'primary',
                                        'dikemas' => 'warning',
                                        'dikirim' => 'info',
                                        'selesai' => 'success',
                                        ];
                                        @endphp

                                        <span class="badge bg-{{ $badgeColors[$order->status] ?? 'secondary' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>Rp{{ number_format($order->total_payment, 0, ',', '.') }}</td>
                                    <td>{{ $order->formatted_created_at }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->uuid) }}" class="btn btn-sm btn-info"
                                            title="Detail">
                                            <i class="fa fa-eye text-white"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data pesanan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
