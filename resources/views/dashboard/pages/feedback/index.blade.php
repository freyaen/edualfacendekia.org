@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>Feedback</h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Feedback</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row size-column">
        <div class="col-xxl-9 box-col-12">
            <div class="col-xxl-12">
                <div class="card recent-order">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="m-0">Daftar Feedback</h4>
                            <a href="{{ route('feedback.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Tambah Feedback
                            </a>
                        </div>

                        <div class="project-table table-responsive custom-scrollbar">
                            <table class="order-table project-table w-100 mb-3">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($feedback as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ Str::limit($item->description, 50) }}</td>
                                        <td>
                                            @if ($item->image)
                                            <img src="{{ asset('storage/feedback/' . $item->image) }}" width="50" alt="Image">
                                            @else
                                            <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('feedback.edit', $item->uuid) }}"
                                                    class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fa fa-pencil text-white"></i>
                                                </a>

                                                <button type="button" class="btn btn-sm btn-danger btn-delete"
                                                    data-id="{{ $item->uuid }}" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                            <form id="form-delete-{{ $item->uuid }}"
                                                action="{{ route('feedback.destroy', $item->uuid) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada feedback</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                                {{ $feedback->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data feedback akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`form-delete-${id}`).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
