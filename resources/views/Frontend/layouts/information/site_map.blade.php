<?php
 use App\Section;
    $sections = Section::sections();
?>
@extends('Frontend.master')
@section('content')
<!--=====================
    Breadcrumb Aera Start
    =========================-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li>
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li><i class="fa fa-caret-right" aria-hidden="true"></i>Site Map</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====================
    Breadcrumb Aera End
    =========================-->
    <!--======================
    login area Start
    ==========================-->
    <div class="login-area mt-25">
        <div class="container">
             <div class="row">
                <div class="offset-lg-2 col-lg-8 text-center">
                    <div class="about-head">
                        <h3 class="mb-20">Welcome To Circle shop!</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia minima consequuntur nulla voluptate sunt accusamus error dolores laboriosam facere, et saepe, velit incidunt doloremque ab eius. Explicabo magnam iure et.</p>
                    </div>
                </div>
            </div>

            @foreach ($sections  as $section)
            <section id="sec1">
                <h2><a href="{{ route('section-menu',$section['slug']) }}" target="_blank" class="sec1-a">{{ $section['section_name'] }}</a></h2>
                <div class="row">
                @foreach ($section['categories'] as $category)
                    <div class="col-md-3">
                        <ul>
                            <li><p><a href="{{ route('header-menu',$category['slug']) }}" target="_blank">{{ $category['category_name'] }}</a></p>
                                <ul>
                                    @foreach ($category['subcategories'] as $subcategory)
                                    <li><a href="{{ route('header-menu',$subcategory['slug']) }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">{{ $subcategory['category_name'] }}</span></a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endforeach
                </div>
            </section>
            @endforeach
        </div>
            <!-- /container -->
    </div>
    <div class="login-area mt-25">
        <div class="container">
            <section id="sec1">
                <div class="row">
                    <div class="col-md-3">
                        <ul>
                            <li><p><a href="{{ url('/') }}" target="_blank">Home</a></p>
                                <ul>
                                    <li><a href="{{ route('about.us') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">About Us</span></a></li>
                                    <li><a href="{{ route('privacy.policy') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Privecy Policy</span></a></li>
                                    <li><a href="{{ route('mission.vision') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Mission & Vision</span></a></li>
                                    <li><a href="{{ route('terms.condition') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Terms & Conditions (Warranty)</span></a></li>
                                    <li><a href="{{ route('return.refund') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Return & Refund Policy</span></a></li>
                                    <li><a href="{{ route('emi.policy') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">EMI Policy</span></a></li>
                                    <li><a href="{{ route('payment.policy') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Payment Policy</span></a></li>
                                    <li><a href="{{ route('delivery.policy') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Delivery Policy</span></a></li>
                                    <li><a href="{{ route('job.circular') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Job Circular</span></a></li>
                                    <li><a href="{{ route('all.brands') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Brands</span></a></li>
                                    <li><a href="{{ route('contact.us') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Contact Us</span></a></li>
                                    <li><a href="{{ route('site.map') }}" target="_blank">&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;<span class="underline">Sitemap</span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
            <!-- /container -->
    </div>
@endsection
