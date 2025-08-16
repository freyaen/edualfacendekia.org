@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')
    <!-- faq area start -->
<div class="faq_content_area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="faq_content_wrapper text-center">
                    <h4>{{ LanguageController::t('Konsultasi Pengiriman') }}</h4>
                    <p>{{ LanguageController::t('Jika Anda memiliki pertanyaan mengenai pengiriman, Anda dapat langsung menghubungi kami melalui beberapa kontak berikut. Tim kami siap membantu Anda.') }}</p>
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
                                {{ LanguageController::t('Hubungi via WhatsApp') }}
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordion">
                            <div class="card-body text-center">
                                <p>{{ LanguageController::t('Silakan hubungi kami langsung melalui WhatsApp di:') }}</p>
                                <a href="https://wa.me/628563541632" target="_blank" class="btn btn-success">
                                    <i class="fa fa-whatsapp"></i> +62 856-3541-632
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card card_dipult">
                        <div class="card-header card_accor" id="headingTwo">
                            <button class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                {{ LanguageController::t('Hubungi via Telepon') }}
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                            data-parent="#accordion">
                            <div class="card-body text-center">
                                <p>{{ LanguageController::t('Anda juga bisa langsung menelepon kami di nomor:') }}</p>
                                <a href="tel:+6285732877774" class="btn btn-primary">
                                    <i class="fa fa-phone"></i> +62 856-3541-632
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card card_dipult">
                        <div class="card-header card_accor" id="headingThree">
                            <button class="btn btn-link collapsed" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                {{ LanguageController::t('Hubungi via Instagram') }}
                                <i class="fa fa-plus"></i>
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                            data-parent="#accordion">
                            <div class="card-body text-center">
                                <p>{{ LanguageController::t('Ikuti dan hubungi kami di Instagram:') }}</p>
                                <a href="https://instagram.com/florasan.id" target="_blank" class="btn btn-danger">
                                    <i class="fa fa-instagram"></i> @florasan.id
                                </a>
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