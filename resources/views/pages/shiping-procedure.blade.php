@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')
    <!-- faq area start -->
<div class="faq_content_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="faq_content_wrapper text-center">
                    <h4>{{ LanguageController::t('Prosedur Pengiriman Pesanan') }}</h4>
                    <p>{{ LanguageController::t('Untuk memastikan kenyamanan Anda, berikut adalah tahapan pengiriman yang perlu diketahui dalam proses pembelian di toko kami.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- faq area end -->

<!-- Accordion area start -->
<div class="accordion_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="accordion" class="card__accordion">

                    <div class="card card_dipult">
                        <div class="card-header card_accor" id="headingOne">
                            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                aria-expanded="true" aria-controls="collapseOne">
                                {{ LanguageController::t('1. Konfirmasi Pembayaran') }}
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>{{ LanguageController::t('Setelah Anda menyelesaikan pembayaran, silakan lakukan konfirmasi pembayaran melalui halaman') }} <strong>{{ LanguageController::t('Pesanan Saya') }}</strong>. {{ LanguageController::t('Ini penting agar pesanan Anda segera diproses oleh admin kami.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card card_dipult">
                        <div class="card-header card_accor" id="headingTwo">
                            <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                {{ LanguageController::t('2. Pesanan Diproses dan Dikirim oleh Admin') }}
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>{{ LanguageController::t('Setelah pembayaran Anda dikonfirmasi, pesanan akan segera dikemas dan dikirim oleh admin. Kami memastikan semua pesanan diproses sesuai dengan antrian yang masuk.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card card_dipult">
                        <div class="card-header card_accor" id="headingThree">
                            <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                {{ LanguageController::t('3. Nomor Resi Dikirim ke Pesanan Anda') }}
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>{{ LanguageController::t('Setelah pengiriman dilakukan, admin akan menginput nomor resi pengiriman. Anda dapat melihat nomor resi ini di detail pesanan Anda untuk melakukan tracking pengiriman.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card card_dipult">
                        <div class="card-header card_accor" id="headingFour">
                            <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                {{ LanguageController::t('4. Konfirmasi Pesanan Selesai') }}
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                            data-parent="#accordion">
                            <div class="card-body">
                                <p>{{ LanguageController::t('Setelah pesanan diterima, silakan lakukan konfirmasi selesai pada halaman') }} <strong>{{ LanguageController::t('Detail Pesanan') }}</strong>. {{ LanguageController::t('Ini membantu kami memastikan pesanan telah sampai dengan baik.') }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Accordion area end -->

@endsection