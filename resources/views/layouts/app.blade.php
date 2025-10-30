@include('layouts.head')

@php use App\Http\Controllers\LanguageController; @endphp

<!--header area start-->

<!--offcanvas menu area start-->
<div class="off_canvars_overlay">

</div>
<div class="offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="javascript:void(0)"><i class="icon-menu"></i></a>
                </div>
                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="icon-x"></i></a>
                    </div>
                    <div class="language_currency text-center">
                        <ul>
                            <li class="language">
                                @php
                                $currentLang = app()->getLocale();
                                $languageNames = [
                                'id' => LanguageController::t('Indonesia'),
                                'en' => LanguageController::t('English'),
                                'ja' => LanguageController::t('日本語')
                                ];
                                $currentLanguageName = $languageNames[$currentLang] ?? $languageNames['id'];
                                @endphp

                                {{ $currentLanguageName }} <i class="fa fa-angle-down"></i>

                                <form action="{{ route('set.language') }}" method="POST" id="langForm-mobile">
                                    @csrf
                                    <input type="hidden" name="lang" id="langInput-mobile">
                                </form>

                                <ul class="dropdown_language">
                                    <li><a href="#" onclick="setLang('id')" @if($currentLang=='id' ) class="active"
                                            @endif>{{ LanguageController::t('Indonesia') }}</a></li>
                                    <li><a href="#" onclick="setLang('en')" @if($currentLang=='en' ) class="active"
                                            @endif>{{ LanguageController::t('English') }}</a></li>
                                    <li><a href="#" onclick="setLang('ja')" @if($currentLang=='ja' ) class="active"
                                            @endif>{{ LanguageController::t('日本語') }}</a></li>
                                </ul>

                                <script>
                                    function setLang(code) {
                                        document.getElementById('langInput-mobile').value = code;
                                        document.getElementById('langForm-mobile').submit();
                                    }

                                </script>
                            </li>
                        </ul>
                    </div>
                    <div class="call-support">
                        <p>{{ LanguageController::t('Kebutuhan Publikasi') }}: <a href="https://wa.me/628563541632"
                                target="_blank">+62 856-3541-632</a>
                        </p>
                    </div>
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li class="active"><a href="{{route('index')}}">{{ LanguageController::t('Belanja') }}</a>
                            </li>
                            <li><a
                                    href="{{route('shiping-procedure')}}">{{ LanguageController::t('Prosedur Pengiriman') }}</a>
                            </li>
                            <li><a
                                    href="{{route('shiping-ask')}}">{{ LanguageController::t('Konsultasi Pengiriman') }}</a>
                            </li>
                            <li><a
                                    href="{{route('company-profile')}}">{{ LanguageController::t('Profil Perusahaan') }}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="mb-0 mt-3">
                        @auth
                        <div class="d-flex justify-content-center align-items-center mt-3">
                            <div class="top_links">
                                <a href="{{route('profile')}}"><i class="icon-user"></i></a>
                            </div>
                            <div class=" mini_cart_wrapper mx-3">
                                <a href="{{route('cart')}}"><i class="icon-shopping-bag"></i><span
                                        class="item_count">{{count(Auth::user()->cart->details ?? [])}}</span></a>
                            </div>
                            <div class="mini_cart_wrapper">
                                <a href="{{ route('orders.list') }}">
                                    <i class="icon-box"></i>
                                    <span class="item_count">{{ Auth::user()->ordersActive()->count() }}</span>
                                </a>
                            </div>
                        </div>

                        @endauth
                        @guest
                        <a href="{{route('login')}}"
                            class="button mt-0 fs-6 w-100 text-center"><small>{{ LanguageController::t('Bergabung Sekarang') }}</small></a>
                        @endguest
                    </div>

                    <div class="offcanvas_footer">
                        <ul>
                            <li class="instagram"><a href="https://www.instagram.com/" target="_blank"><i
                                        class="fa fa-instagram"></i></a></li>
                            <li class="youtube"><a href="https://www.youtube.com" target="_blank"><i
                                        class="fa fa-youtube"></i></a></li>
                            <li class="facebook"><a href="https://www.facebook.com/" target="_blank"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li class="tiktok">
                                <a href="https://www.tiktok.com" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15" height="15">
                                        <path fill="#fff"
                                            d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--offcanvas menu area end-->
<header>
    <div class="main_header">
        <div class="header_top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 col-md-7">
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div class="language_currency text-right">
                            <ul>
                                <li class="language">
                                    @php
                                    $currentLang = app()->getLocale();
                                    $languageNames = [
                                    'id' => LanguageController::t('Indonesia'),
                                    'en' => LanguageController::t('English'),
                                    'ja' => LanguageController::t('日本語')
                                    ];
                                    $currentLanguageName = $languageNames[$currentLang] ?? $languageNames['id'];
                                    @endphp

                                    {{ $currentLanguageName }} <i class="fa fa-angle-down"></i>

                                    <form action="{{ route('set.language') }}" method="POST" id="langForm">
                                        @csrf
                                        <input type="hidden" name="lang" id="langInput">
                                    </form>

                                    <ul class="dropdown_language">
                                        <li>
                                            <a href="#" onclick="setLang('id')" @if($currentLang=='id' ) class="active"
                                                @endif>
                                                {{ LanguageController::t('Indonesia') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="setLang('en')" @if($currentLang=='en' ) class="active"
                                                @endif>
                                                {{ LanguageController::t('English') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" onclick="setLang('ja')" @if($currentLang=='ja' ) class="active"
                                                @endif>
                                                {{ LanguageController::t('日本語') }}
                                            </a>
                                        </li>
                                    </ul>

                                    <script>
                                        function setLang(code) {
                                            document.getElementById('langInput').value = code;
                                            document.getElementById('langForm').submit();
                                        }

                                    </script>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-3 col-4 ">
                        <div class="logo">
                            <a href="{{route('index')}}"><img  src="assets/img/logo/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6 col-6">
                        <div class="header_right_info">
                            <div class="header_account_area">
                                @auth
                                <div class="header_account-list top_links">
                                    <a href="{{route('profile')}}"><i class="icon-user"></i></a>
                                </div>
                                <div class="header_account-list  mini_cart_wrapper">
                                    <a href="{{route('cart')}}"><i class="icon-shopping-bag"></i><span
                                            class="item_count">{{count(Auth::user()->cart->details ?? [])}}</span></a>
                                </div>
                                <div class="header_account-list mini_cart_wrapper">
                                    <a href="{{ route('orders.list') }}">
                                        <i class="icon-box"></i>
                                        <span class="item_count">{{ Auth::user()->ordersActive()->count() }}</span>
                                    </a>
                                </div>
                                @endauth
                                @guest
                                <a href="{{route('login')}}"
                                    class="button mt-0 fs-6"><small>{{ LanguageController::t('Bergabung Sekarang') }}</small></a>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <!--main menu start-->
                        <div class="main_menu menu_position">
                            <nav>
                                <ul>
                                    <li class="active"><a
                                            href="{{route('index')}}">{{ LanguageController::t('Belanja') }}</a></li>
                                    <li><a
                                            href="{{route('shiping-procedure')}}">{{ LanguageController::t('Prosedur Pengiriman') }}</a>
                                    </li>
                                    <li><a
                                            href="{{route('shiping-ask')}}">{{ LanguageController::t('Konsultasi Pengiriman') }}</a>
                                    </li>
                                    <li><a
                                            href="{{route('company-profile')}}">{{ LanguageController::t('Profil Perusahaan') }}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!--main menu end-->
                    </div>
                    <div class="col-lg-4">
                        <div class="call-support">
                            <p>{{ LanguageController::t('Kebutuhan Publikasi') }}: <a href="https://wa.me/628563541632"
                                    target="_blank">+62 8563541632</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header area end-->

@yield('content')

<!--footer area start-->
<footer class="footer_widgets">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="widgets_container contact_us">
                        <h3>{{ LanguageController::t('Jam Buka') }}</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="contact.html">{{ LanguageController::t('Buka Setiap Hari') }}</a></li>
                                <!-- <li><a href="contact.html">{{ LanguageController::t('Kecuali hari Jum\'at') }}</a></li> -->
                                <li><a href="contact.html">{{ LanguageController::t('07:00 - 17:00') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>{{ LanguageController::t('Informasi') }}</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="{{route('index')}}">{{ LanguageController::t('Belanja') }}</a></li>
                                <li><a href="about.html">{{ LanguageController::t('Prosedur Pengirman') }}</a></li>
                                <li><a href="checkout.html">{{ LanguageController::t('Konsultasi Pengiriman') }}</a>
                                </li>
                                <li><a href="contact.html">{{ LanguageController::t('Profil Perusahaan') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="widgets_container widget_app">
                        <div class="footer_logo">
                            <a href="{{route('index')}}"><img width="100" src="assets/img/logo/logo.png" alt="Logo"></a>
                        </div>
                        <div class="footer_social">
                            <ul>
                                <li><a href="https://www.instagram.com/" target="_blank"><i
                                            class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.youtube.com" target="_blank"><i
                                            class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.facebook.com/" target="_blank"><i
                                            class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li>
                                    <a href="https://www.tiktok.com" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15"
                                            height="15">
                                            <path fill="#000"
                                                d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>{{ LanguageController::t('Akun Saya') }}</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="contact.html">{{ LanguageController::t('Profil') }}</a></li>
                                <li><a href="cart.html">{{ LanguageController::t('Keranjang') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <div class="widgets_container widget_menu">
                        <h3>{{ LanguageController::t('Butuh Bantuan') }}</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="https://wa.me/628563541632"
                                        target="_blank">{{ LanguageController::t('Hubungi Saya') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="copyright_area">
                <p class="copyright-text mx-auto text-center">&copy; 2025 <a href="index-2.html">Florasan.id</a>.</p>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->

@include('layouts.tail')
