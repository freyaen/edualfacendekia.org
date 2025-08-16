@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')

<!--slider area start-->
<section class="slider_section">
    <div class="slider_area owl-carousel">
        <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider1.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider_content">
                            <h1>{{ LanguageController::t('TANAMAN LENGKAP') }}</h1>
                            <p>{{ LanguageController::t('Berbagai jenis tanaman tersedia untuk semua kebutuhan Anda') }}</p>
                            <a class="button" href="#shop">{{ LanguageController::t('Belanja Sekarang') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider_content">
                            <h1>{{ LanguageController::t('PENGIRIMAN CEPAT') }}</h1>
                            <p>{{ LanguageController::t('Pesanan dikirim dengan cepat & aman sampai ke tangan Anda') }}</p>
                            <a class="button" href="#shop">{{ LanguageController::t('Belanja Sekarang') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single_slider d-flex align-items-center" data-bgimg="assets/img/slider/slider3.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="slider_content">
                            <h1>{{ LanguageController::t('HARGA TERJANGKAU') }}</h1>
                            <p>{{ LanguageController::t('Kualitas terbaik dengan harga ramah di kantong') }}</p>
                            <a class="button" href="#shop">{{ LanguageController::t('Belanja Sekarang') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--slider area end-->

<!--shipping area start-->
<div class="shipping_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single_shipping">
                    <div class="shipping_icone">
                        <img src="assets/img/about/shipping1.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>{{ LanguageController::t('Pengiriman Cepat') }}</h3>
                        <p>{{ LanguageController::t('Pengeriman kami cepat & aman') }} <br> {{ LanguageController::t('jadi anda tidak perlu khawatir') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_shipping col_2">
                    <div class="shipping_icone">
                        <img src="assets/img/about/shipping2.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>{{ LanguageController::t('Pembayaran Aman') }}</h3>
                        <p>{{ LanguageController::t('Transaksi mudah & aman dengan berbagai') }} <br> {{ LanguageController::t('metode pembayaran terpercaya') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_shipping col_3">
                    <div class="shipping_icone">
                        <img src="assets/img/about/shipping3.png" alt="">
                    </div>
                    <div class="shipping_content">
                        <h3>{{ LanguageController::t('Pelayanan Ramah') }}</h3>
                        <p>{{ LanguageController::t('Hubungi kami jika ada pertanyaan') }} <br> {{ LanguageController::t('kami selalu siap membantu') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--shipping area end-->

<!--banner area start-->
<div class="banner_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <figure class="single_banner">
                    <div class="banner_thumb">
                        <a href="#shop"><img src="assets/img/bg/banner1.jpg" alt=""></a>
                        <div class="banner_content">
                            <h3>{{ LanguageController::t('Pilihan Tanaman Lengkap') }}</h3>
                            <h2>{{ LanguageController::t('Cocok') }} <br> {{ LanguageController::t('Untuk Rumah Anda') }}</h2>
                            <a href="#shop">{{ LanguageController::t('Belanja Sekarang') }}</a>
                        </div>
                    </div>
                </figure>
            </div>
            <div class="col-lg-6 col-md-6">
                <figure class="single_banner">
                    <div class="banner_thumb">
                        <a href="#shop"><img src="assets/img/bg/banner2.jpg" alt=""></a>
                        <div class="banner_content">
                            <h3>{{ LanguageController::t('Kirim Cepat & Aman') }}</h3>
                            <h2>{{ LanguageController::t('Pesan') }} <br> {{ LanguageController::t('Kami Antar') }}</h2>
                            <a href="#shop">{{ LanguageController::t('Belanja Sekarang') }}</a>
                        </div>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</div>
<!--banner area end-->

<!--product area start-->
<div class="product_area  mb-95">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_header">
                    <div class="section_title">
                        <h2>{{ LanguageController::t('Produk Kita') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                <div class="row justify-content-center">
                    <div class="col-md-12 mb-5">
                        <div class="search_container">
                            <form action="{{ route('index') }}" method="GET" class="mx-auto w-100">
                                <div class="hover_category">
                                    <select class="select_option" name="type_uuid" id="type_uuid">
                                        <option @if(!request('type_uuid')) selected @endif value="">{{ LanguageController::t('Semua Jenis Produk') }}
                                        </option>
                                        @foreach ($data['types'] as $item)
                                        <option @if(request('type_uuid')==$item->uuid) selected @endif
                                            value="{{$item->uuid}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="search_box">
                                    <input placeholder="{{ LanguageController::t('Cari produk...') }}" type="text" name="keyword"
                                        value="{{ request('keyword') }}">
                                    <button type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @foreach ($data['products'] as $item)
                    <div class="col-md-3 mb-4">
                        <div class="product_items">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <div class="primary_img"><img
                                                src="{{ asset('storage/products/' . $item->images[0]->name) }}">
                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart">
                                                    <a href="#" title="{{ LanguageController::t('Add to cart') }}"
                                                        onclick="event.preventDefault(); document.getElementById('add-to-cart-form-{{$item->uuid}}').submit();">
                                                        <i class="icon-shopping-bag"></i>
                                                    </a>
                                                    <form id="add-to-cart-form-{{$item->uuid}}"
                                                        action="{{ route('cart.add', $item->uuid) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                        <input type="hidden" name="qty" value="1">
                                                    </form>
                                                </li>
                                                <li class="quick_button"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modal_box_{{$item->uuid}}" title="{{ LanguageController::t('quick view') }}">
                                                        <i class="icon-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a>{{$item->name}}</a></h4>
                                        <div class="mt-1 mb-3 text-muted">
                                            <p class="mb-0">Ukuran: {{$item->volume . ' ' . $item->unit}}</p>
                                            <p>Stok: {{$item->stock}}</p>
                                        </div>
                                        <div class="price_box mt-2">
                                            <span
                                                class="current_price">Rp{{number_format($item->price, 0, '.', '.')}}</span>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    </div>

                    <!-- modal area start-->
                    <div class="modal fade" id="modal_box_{{$item->uuid}}" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="icon-x"></i></span>
                                </button>
                                <div class="modal_body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-12">
                                                <div class="modal_tab">
                                                    <div class="tab-content product-details-large">
                                                        @foreach ($item->images as $index => $image)
                                                        <div class="tab-pane fade {{$index == 0 ? 'active' : ''}}"
                                                            id="{{$image->uuid}}" role="tabpanel">
                                                            <div class="modal_tab_img">
                                                                <a href="#"><img
                                                                        src="{{asset('storage/products/' . $image->name)}}"
                                                                        alt=""></a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal_tab_button">
                                                        <ul class="nav product_navactive owl-carousel" role="tablist">
                                                            @foreach ($item->images as $index => $image)
                                                            <li>
                                                                <a class="nav-link {{$index == 0 ? 'active' : ''}}"
                                                                    data-bs-toggle="tab" href="#{{$image->uuid}}"
                                                                    role="tab" aria-controls="{{$image->uuid}}"
                                                                    aria-selected="false"><img
                                                                        src="{{asset('storage/products/' . $image->name)}}"
                                                                        alt=""></a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-7 col-sm-12">
                                                <div class="modal_right">
                                                    <div class="modal_title mb-10">
                                                        <h2 class="m-0">{{$item->name}}</h2>
                                                        <div class="mt-1 mb-3 text-muted">
                                                            <p class="mb-0">Ukuran: {{$item->volume . ' ' . $item->unit}}</p>
                                                            <p>Stok: {{$item->stock}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal_price mb-10">
                                                        <span
                                                            class="new_price">Rp{{number_format($item->price, 0, '.', '.')}}</span>
                                                    </div>
                                                    <div class="modal_description mb-15">
                                                        <p>{!! LanguageController::t($item->description)!!}</p>
                                                    </div>
                                                    <div class="variants_selects">
                                                        <div class="modal_add_to_cart">
                                                            <form action="{{ route('cart.add', $item->uuid) }}"
                                                                method="POST">
                                                                @csrf
                                                                <input name="qty" min="1" max="100" step="1" value="1"
                                                                    type="number">
                                                                <button type="submit">{{ LanguageController::t('Tambah ke Keranjang') }}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal area end-->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--product area end-->
@endsection