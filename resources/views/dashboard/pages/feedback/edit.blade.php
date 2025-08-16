@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>Edit Feedback</h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"><a href="{{ route('feedback') }}">Feedbacks</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('feedback.update', $feedback->uuid) }}" method="POST" enctype="multipart/form-data" id="form-edit">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="name">Nama</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $feedback->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" rows="4"
                        class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $feedback->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="image">Gambar (Optional)</label>
                    <input type="file" name="image" class="form-control">
                    @if($feedback->image)
                    <img src="{{ asset('storage/feedback/' . $feedback->image) }}" width="100" class="mt-2" alt="Image">
                    @endif
                </div>

                <div class="form-group mt-4">
                    <button class="btn btn-primary" type="button" id="btn-submit-edit">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('feedback') }}" class="btn btn-light">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('btn-submit-edit').addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin update feedback?',
            text: "Perubahan akan disimpan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#form-edit').submit();
            }
        });
    });
</script>
@endpush
