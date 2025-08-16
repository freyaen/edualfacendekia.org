@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h4>Edit Produk</h4>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item"><a href="{{ route('products') }}">Produk</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product->uuid) }}" method="POST" id="product-form"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="store_uuid" value="9f5fab4a-1bdf-43cb-a063-b79fe61d1157">

                @method('PUT')
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <div class="form-group">
                            <label for="type_uuid">Kategori</label>
                            <select name="type_uuid" id="type_uuid"
                                class="form-control @error('type_uuid') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($data['types'] as $item)
                                <option value="{{ $item->uuid }}" {{ $item->uuid == $product->type_uuid ? 'selected' : '' }}>
                                    {{ $item->name}}
                                </option>
                                @endforeach
                            </select>
                            @error('type_uuid')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <div class="form-group">
                            <label for="images">Gambar Produk</label>
                            <input type="file" name="images[]" id="images"
                                class="form-control @error('images.*') is-invalid @enderror" multiple accept="image/*">
                            @error('images.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Unggah satu atau lebih gambar produk (maks 10MB per gambar)</small>
                        </div>
                    </div>
                    @if($product->images->count() > 0)
                    <div class="row mb-3">
                        <div class="col-12">
                            <h6>Gambar Saat Ini</h6>
                            <div class="d-flex flex-wrap gap-3">
                                @foreach($product->images as $image)
                                <div class="position-relative" style="width: 150px;">
                                    <img src="{{ asset('storage/products/' . $image->name) }}" alt="Gambar Produk"
                                        class="img-thumbnail" style="width: 100%; height: 150px; object-fit: cover;">
                                    <div class="form-check position-absolute top-0 start-0 p-0 m-1">
                                        <input type="checkbox" name="delete_images[]" value="{{ $image->uuid }}"
                                            class="form-check-input" id="delete_image_{{ $image->uuid }}">
                                        <label class="form-check-label" for="delete_image_{{ $image->uuid }}"></label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <small class="text-muted">Centang gambar yang ingin dihapus</small>
                        </div>
                    </div>
                    @endif
                    <div class="mb-3 col-md-12">
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $product->name) }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 col-md-12">
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea name="description" id="description" rows="3"
                                class="form-control @error('description') is-invalid @enderror"
                                required>{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stok</label>
                                    <input type="number" name="stock" id="stock"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        value="{{ old('stock', $product->stock) }}" min="0" required>
                                    @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="form-group">
                                    <label for="price">Harga (Rp)</label>
                                    <input type="number" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', $product->price) }}" min="0" required>
                                    @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                </div>


                <div class="form-group mt-4">
                    <button class="btn btn-primary" type="button" id="btn-submit">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('products') }}" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

<script>
    
    document.getElementById('btn-submit').addEventListener('click', function () {
        Swal.fire({
            title: 'Yakin simpan perubahan?',
            text: "Data produk akan diperbarui.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector('#product-form').submit();
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
    function deleteImage(imageId) {
        Swal.fire({
            title: 'Yakin hapus gambar?',
            text: "Gambar akan dihapus permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-image-${imageId}`).submit();
            }
        });
    }

</script>
@endpush
