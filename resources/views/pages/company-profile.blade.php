@extends('layouts.app')

@php use App\Http\Controllers\LanguageController; @endphp

@section('content')
<!--about section area -->
<section class="about_section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <figure>
                    <div class="about_thumb">
                        <img class="w-100" src="{{asset('storage/company-profile/' . $companyProfile->banner_image)}}"
                            alt="">
                    </div>
                    <figcaption class="about_content">
                        <h1>{{LanguageController::t($companyProfile->title)}}</h1>
                        <p>{!! LanguageController::t($companyProfile->description) !!}</p>
                    </figcaption>
                </figure>
            </div>
        </div>
    </div>
</section>
<!--about section end-->

<!--services img area-->
<div class="about_gallery_section">
    <div class="container">
        <div class="about_gallery_container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img class="w-100" height="250"
                                    src="{{asset('storage/company-profile/' . $companyProfile->section_one_image)}}"
                                    alt="">
                            </div>
                            <figcaption class="about_gallery_content">
                                <h3>{{LanguageController::t($companyProfile->section_one_title)}}</h3>
                                <p>{!! LanguageController::t($companyProfile->section_one_description) !!}</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-4">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img class="w-100" height="250"
                                    src="{{asset('storage/company-profile/' . $companyProfile->section_two_image)}}"
                                    alt="">
                            </div>
                            <figcaption class="about_gallery_content">
                                <h3>{{LanguageController::t($companyProfile->section_two_title)}}</h3>
                                <p>{!! LanguageController::t($companyProfile->section_two_description) !!}</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                <div class="col-lg-4 col-md-4">
                    <article class="single_gallery_section">
                        <figure>
                            <div class="gallery_thumb">
                                <img s class="w-100" height="250"
                                    src="{{asset('storage/company-profile/' . $companyProfile->section_three_image)}}"
                                    alt="">
                            </div>
                            <figcaption class="about_gallery_content">
                                <h3>{{LanguageController::t($companyProfile->section_three_title)}}</h3>
                                <p>{!! LanguageController::t($companyProfile->section_three_description) !!}</p>
                            </figcaption>
                        </figure>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<!--services img end-->

<!--testimonial area start-->
<div class="faq-client-say-area">
    <div class="container">
        <!--testimonial area start-->
        <div class="testimonial_area  testimonial_about">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title">
                            <h2>{{ LanguageController::t('Apa kata mereka?') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="testimonial_container">
                    <div class="row">
                        <div class="testimonial_carousel owl-carousel">
                            @foreach ($feedback as $item)
                            <div class="col-12">
                                <div class="single-testimonial">
                                    <div class="testimonial-icon-img">
                                        <img src="assets/img/about/testimonials-icon.png" alt="">
                                    </div>
                                    <div class="testimonial_content">
                                        <p class="mb-3">"{{LanguageController::t($item->description)}}"
                                        </p>
                                        <div class="ratio ratio-1x1 testimonial-icon-img mx-auto" style="width: 100px;">
                                            <img src="{{asset('storage/feedback/' . $item->image)}}"
                                                class="rounded-circle object-fit-cover" alt="{{$item->name}}">
                                        </div>
                                        <div class="testimonial_author">
                                            <p><a href="#">{{$item->name}}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--testimonial area end-->
    </div>
</div>
<!--testimonial area end-->

<!--store area start-->
<div class="faq-client-say-area">
    <div class="container">
        <!--store area start-->
        <div class="store_area  store_about">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title">
                            <h2>{{ LanguageController::t('Temukan Kita') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="store_container ">
                    @foreach ($stores as $item)
                    <div class="mb-5">
                        <h3 class="text-center mb-3">{{$item->name}}</h3>
                        <iframe class="w-100" height="450" style="border:0" loading="lazy" allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://www.google.com/maps?q={{$item->latitude}},{{$item->longitude}}&output=embed">
                        </iframe>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--store area end-->
    </div>
</div>
<!--store area end-->
@endsection