@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>Produk</h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Produk</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row size-column">
        <div class="col-xxl-9 box-col-12">
            <div class="col-xxl-12">
                <div class="card recent-order">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">Daftar Produk</h4>
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Tambah Produk
                            </a>
                        </div>

                        <div class="project-table table-responsive custom-scrollbar">
                            <table class="order-table project-table w-100 mb-3">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Jenis</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data['products'] as $product)
                                    <tr>
                                        <td>
                                            @if($product->images->count() > 0)
                                                <img src="{{ asset('storage/products/' . $product->images[0]->name) }}" 
                                                    alt="{{ $product->name }}" 
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div style="width: 50px; height: 50px; background: #eee; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fa fa-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->type->name }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('products.edit', $product->uuid) }}"
                                                    class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fa fa-pencil text-white"></i>
                                                </a>

                                                <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                    data-id="{{ $product->uuid }}" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <form id="form-delete-{{ $product->uuid }}"
                                                action="{{ route('products.destroy', $product->uuid) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada produk</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-3">
                                {{ $data['products']->links('pagination::bootstrap-5') }}
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Produk akan dihapus permanen beserta semua gambarnya.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`form-delete-${productId}`).submit();
                    }
                });
            });
        });
    });
</script>
@endpush