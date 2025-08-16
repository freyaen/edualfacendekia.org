@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>
                    Rekap </h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Rekap</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row size-column">
        <div class="col-xxl-9 box-col-12">
            <div class="row justify-content-between">
                <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                        <div class="card-body total-project border-b-primary border-2">
                            <span class="f-light f-w-500 f-14">Total Produk</span>
                            <div class="project-details">
                                <div class="project-counter">
                                    <h2 class="f-w-600">{{number_format($data['totalProducts'], 0, '.', '.')}}</h2>
                                </div>
                                <div class="product-sub bg-primary-light text-white">
                                    <i class="fa fa-cube fa-2x"></i>
                                </div>
                            </div>
                            <ul class="bubbles">
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                        <div class="card-body total-project border-b-primary border-2">
                            <span class="f-light f-w-500 f-14">Total Pesanan</span>
                            <div class="project-details">
                                <div class="project-counter">
                                    <h2 class="f-w-600">{{number_format($data['totalOrders'], 0, '.', '.')}}</h2>
                                </div>
                                <div class="product-sub bg-primary-light text-white">
                                    <i class="fa fa-list-alt fa-2x"></i>
                                </div>
                            </div>
                            <ul class="bubbles">
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                @if ($data['user']->role == 'superadmin')
                <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                        <div class="card-body total-project border-b-primary border-2">
                            <span class="f-light f-w-500 f-14">Total Customer</span>
                            <div class="project-details">
                                <div class="project-counter">
                                    <h2 class="f-w-600">{{number_format($data['totalCustomers'], 0, '.', '.')}}</h2>
                                </div>
                                <div class="product-sub bg-primary-light text-white">
                                    <i class="fa fa-users fa-2x"></i>
                                </div>
                            </div>
                            <ul class="bubbles">
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col-xl-3 col-sm-6">
                    <div class="card o-hidden small-widget">
                        <div class="card-body total-project border-b-primary border-2">
                            <span class="f-light f-w-500 f-14">Total Pendapatan</span>
                            <div class="project-details">
                                <div class="project-counter">
                                    <h2 class="f-w-600">Rp{{number_format($data['totalIncome'], 0, '.', '.')}}</h2>
                                </div>
                                <div class="product-sub bg-primary-light text-white">
                                    <i class="fa fa-money fa-2x"></i>
                                </div>
                            </div>
                            <ul class="bubbles">
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                                <li class="bubble"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12">
                    <div class="card recent-order">
                        <div class="card-header card-no-border total-revenue">
                            <h4 class="m-0">Pesanan Terbaru</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="project-table table-responsive custom-scrollbar">
                                <table class="order-table project-table w-100 mb-3">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>No</th>
                                            <th>Customer</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data['latestOrders'] as $item)
                                        <tr>
                                            <td>
                                                {{$item->created_at}}
                                            </td>
                                            <td>
                                                {{$item->number}}
                                            </td>
                                            <td>
                                                {{$item->user->name}}
                                            </td>
                                            <td>
                                                Rp{{number_format($item->total_payment, 0, 0, '.')}}
                                            </td>
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
                                                <span class="badge bg-{{ $badgeColors[$item->status] ?? 'secondary' }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('orders.show', $item->uuid) }}"
                                                    class="btn btn-sm btn-info" title="Detail">
                                                    <i class="fa fa-eye text-white"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada pesanan</td>
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
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
