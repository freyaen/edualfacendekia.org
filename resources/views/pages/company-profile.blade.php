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

@endsection