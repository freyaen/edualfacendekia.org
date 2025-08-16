@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>Tambah Jenis Baru</h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"><a href="{{ route('types') }}">Jenis</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('types.store') }}" method="POST" id="type-form">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Jenis</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <button class="btn btn-primary" type="button" id="btn-submit">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('types') }}" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('btn-submit').addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin simpan kategori?',
            text: "Data yang dikirim akan disimpan permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#type-form').submit();
            }
        });
    });

</script>
@endpush
