@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')
<!-- customer login start -->
<div class="customer_login">
    <div class="container">
        <!--login area start-->
        <div class="account_form w-75 mx-auto">
            <h2>{{ LanguageController::t('Masuk') }}</h2>
            <form action="{{route('login')}}" method="POST">
                @csrf

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <p>
                    <label>{{ LanguageController::t('Email') }}<span>*</span></label>
                    <input type="text" name="email">
                </p>
                <p>
                    <label>{{ LanguageController::t('Password') }} <span>*</span></label>
                    <input type="password" name="password">
                </p>
                <div class="d-flex justify-content-between mb-3">
                    <a href="https://wa.me/628563541632">{{ LanguageController::t('Lupa password? Hubungi Admin') }}</a>
                    <a href="{{route('register')}}">{{ LanguageController::t('Belum punya akun? Daftar Sekarang') }}</a>
                </div>

                <button type="submit" class="w-100 m-0">{{ LanguageController::t('Masuk') }}</button>
            </form>
        </div>
        <!--login area start-->
    </div>
</div>
<!-- customer login end -->
@endsection