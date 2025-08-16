@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')
<div class="customer_login">
    <div class="container">
        <div class="account_form w-75 mx-auto">
            <h2>{{ LanguageController::t('Edit Profil') }}</h2>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">{{ LanguageController::t('Nama Lengkap') }} <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="email">{{ LanguageController::t('Email') }} <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="phone">{{ LanguageController::t('No HP Aktif') }} <span class="text-danger">*</span></label>
                    <input type="phone" name="phone" id="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $user->phone) }}" required>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="address">{{ LanguageController::t('Alamat') }} <span class="text-danger">*</span></label>
                    <textarea name="address" id="address" rows="3"
                        class="form-control @error('address') is-invalid @enderror"
                        required>{{ old('address', $user->address) }}</textarea>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <hr class="my-4">

                <h5>{{ LanguageController::t('Ganti Password') }}</h5>
                <small class="text-muted">{{ LanguageController::t('Kosongkan jika tidak ingin mengganti password') }}</small>

                <div class="form-group mt-3">
                    <label for="current_password">{{ LanguageController::t('Password Saat Ini') }}</label>
                    <input type="password" name="current_password" id="current_password"
                        class="form-control @error('current_password') is-invalid @enderror">
                    @error('current_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="password">{{ LanguageController::t('Password Baru') }}</label>
                    <input type="password" name="password" id="password"
                        class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="password_confirmation">{{ LanguageController::t('Konfirmasi Password Baru') }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary w-100">{{ LanguageController::t('Simpan Perubahan') }}</button>
                </div>
            </form>

            <hr class="my-4">

            <!-- Logout Section -->
            <div class="logout-section mt-4">
                <h5>{{ LanguageController::t('Keluar Akun') }}</h5>
                <p class="text-muted">{{ LanguageController::t('Anda bisa keluar dari akun Anda dan masuk kembali kapan saja.') }}</p>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">
                        {{ LanguageController::t('Keluar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection