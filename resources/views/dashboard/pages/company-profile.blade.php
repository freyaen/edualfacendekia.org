@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>Edit Company Profile</h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Company Profile</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('company-profile.update', $companyProfile->uuid) }}" method="POST"
                enctype="multipart/form-data" id="profile-form">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="banner_image">Banner Image</label>
                    <input type="file" name="banner_image" class="form-control">
                    @if ($companyProfile->banner_image)
                    <img src="{{ asset('storage/company-profile/' . $companyProfile->banner_image) }}" alt="Banner"
                        width="150" class="mt-2">
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="title">Judul</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $companyProfile->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                        rows="5" required>{{ old('description', $companyProfile->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Bagian I --}}
                <hr>
                <h5>Bagian I</h5>
                <div class="form-group mb-3">
                    <label for="section_one_image">Gambar</label>
                    <input type="file" name="section_one_image" class="form-control">
                    @if ($companyProfile->section_one_image)
                    <img src="{{ asset('storage/company-profile/' . $companyProfile->section_one_image) }}"
                        alt="Bagian I" width="150" class="mt-2">
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="section_one_title">Judul</label>
                    <input type="text" name="section_one_title" class="form-control"
                        value="{{ old('section_one_title', $companyProfile->section_one_title) }}">
                </div>
                <div class="form-group mb-3">
                    <label for="section_one_description">Deskripsi</label>
                    <textarea name="section_one_description" class="form-control"
                        rows="5">{{ old('section_one_description', $companyProfile->section_one_description) }}</textarea>
                </div>

                {{-- Bagian II --}}
                <hr>
                <h5>Bagian II</h5>
                <div class="form-group mb-3">
                    <label for="section_two_image">Gambar</label>
                    <input type="file" name="section_two_image" class="form-control">
                    @if ($companyProfile->section_two_image)
                    <img src="{{ asset('storage/company-profile/' . $companyProfile->section_two_image) }}"
                        alt="Bagian II" width="150" class="mt-2">
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="section_two_title">Judul</label>
                    <input type="text" name="section_two_title" class="form-control"
                        value="{{ old('section_two_title', $companyProfile->section_two_title) }}">
                </div>
                <div class="form-group mb-3">
                    <label for="section_two_description">Deskripsi</label>
                    <textarea name="section_two_description" class="form-control"
                        rows="5">{{ old('section_two_description', $companyProfile->section_two_description) }}</textarea>
                </div>

                {{-- Bagian III --}}
                <hr>
                <h5>Bagian III</h5>
                <div class="form-group mb-3">
                    <label for="section_three_image">Gambar</label>
                    <input type="file" name="section_three_image" class="form-control">
                    @if ($companyProfile->section_three_image)
                    <img src="{{ asset('storage/company-profile/' . $companyProfile->section_three_image) }}"
                        alt="Bagian III" width="150" class="mt-2">
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="section_three_title">Judul</label>
                    <input type="text" name="section_three_title" class="form-control"
                        value="{{ old('section_three_title', $companyProfile->section_three_title) }}">
                </div>
                <div class="form-group mb-3">
                    <label for="section_three_description">Deskripsi</label>
                    <textarea name="section_three_description" class="form-control"
                        rows="5">{{ old('section_three_description', $companyProfile->section_three_description) }}</textarea>
                </div>

                <div class="form-group mt-4">
                    <button class="btn btn-primary" type="button" id="btn-submit">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-light">Batal</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('btn-submit').addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin update profile?',
            text: "Perubahan akan disimpan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#profile-form').submit();
            }
        });
    });

    document.querySelectorAll('textarea').forEach((textarea) => {
        ClassicEditor
            .create(textarea)
            .then(editor => {
                editor.ui.view.editable.element.style.height = '300px';
            })
            .catch(error => {
                console.error(error);
            });
    });

</script>
@endpush
