@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>
                    Toko </h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Toko</li>
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
                            <h4 class="m-0">Daftar Toko</h4>
                            <a href="{{ route('stores.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Tambah Toko
                            </a>
                        </div>

                        <div class="project-table table-responsive custom-scrollbar">
                            <table class="order-table project-table w-100 mb-3">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kota</th>
                                        <th>Alamat Lengkap</th>
                                        <th>Latitude, Longitude</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data['stores'] as $item)
                                    <tr>
                                        <td>
                                            {{$item->name}}
                                        </td>
                                        <td>
                                            {{$item->city}}
                                        </td>
                                        <td>
                                            {{$item->address}}
                                        </td>
                                        <td>
                                            {{$item->latitude . ',' . $item->longitude}}
                                        </td>
                                        <td class="d-flex gap-2">
                                            <a href="{{ route('stores.edit', $item->uuid) }}"
                                                class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fa fa-pencil text-white"></i>
                                            </a>

                                            <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                data-id="{{ $item->uuid }}" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                            <form id="form-delete-{{ $item->uuid }}"
                                                action="{{ route('stores.destroy', $item->uuid) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada toko</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{$data['stores']->links('pagination::bootstrap-5')}}
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
                const storeId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data toko akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`form-delete-${storeId}`).submit();
                    }
                });
            });
        });
    });

</script>
@endpush
