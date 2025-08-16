@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')
<!-- customer login start -->
<div class="customer_login">
    <div class="container">
        <!--register area start-->
        <div class="account_form w-75 mx-auto">
            <h2>{{ LanguageController::t('Daftar') }}</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p>
                    <label>{{ LanguageController::t('Nama') }}<span>*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    <label>{{ LanguageController::t('Alamat Lengkap') }}<span>*</span></label>
                    <input type="text" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                 <p>
                    <label>{{ LanguageController::t('No HP Aktif') }}<span>*</span></label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    <label>{{ LanguageController::t('Email') }}<span>*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    <label>{{ LanguageController::t('Password') }}<span>*</span></label>
                    <input type="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>
                <p>
                    <label>{{ LanguageController::t('Konfirmasi Password') }}<span>*</span></label>
                    <input type="password" name="password_confirmation" required autocomplete="new-password">
                </p>
                <div class="mb-3">
                    <a href="{{ route('login') }}">{{ LanguageController::t('Sudah punya akun? Masuk Sekarang') }}</a>
                </div>

                <button type="submit" class="w-100 m-0">{{ LanguageController::t('Daftar') }}</button>
            </form>
        </div>
        <!--register area start-->
    </div>
</div>
@endsection