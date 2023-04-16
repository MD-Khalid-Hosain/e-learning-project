@extends('Frontend.master')
@section('title'){{ $description->meta_title }}
@endsection
@section('description')
{{ $description->meta_description }}
@endsection

@section('content')
<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v9.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="2374804922748585"
        logged_in_greeting="অরিজিনাল ষ্টোর বিডি ফেসবুক পেজে আপনাকে স্বাগত। How can i Help You?"
        logged_out_greeting="অরিজিনাল ষ্টোর বিডি ফেসবুক পেজে আপনাকে স্বাগত। How can i Help You?">
    </div>
      <!--=====================
    slider area start
    =========================-->
    <div class="slider_section mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="slider_area slider-one mt-10">
                        <!-- Single Slider Start -->
                        @foreach ($allSliders as $slider)
                            <div class="single_slider">
                                @if ($slider->details == null)
                                <a href="{{ $slider->slider_link }}" target="_blank"><img src="{{ asset('backend/uploads/banners/slider/'.$slider->slider_image) }}" alt="{{ $slider->alt }}" class="img-fluid"></a>
                                @else
                                <a href="{{ route('banner.page', $slider->id) }}" target="_blank"><img src="{{ asset('backend/uploads/banners/slider/'.$slider->slider_image) }}" alt="{{ $slider->alt }}" class="img-fluid"></a>
                                @endif
                            </div>
                        @endforeach
                        <!-- Single Slider End -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--======================
        slider area End
    ==========================-->

    <div class=" toolbar-bottom">
        <div class="container">
            <div class="row">
                    <!-- Right Side Banner Start -->
                    @php
                    $flag=0;
                @endphp
                @foreach ($allImages as $image)

                @if ($flag==0 ||$flag==1 ||$flag==4 ||$flag==5 ||$flag==6 ||$flag==7 ||$flag==10 ||$flag==11 ||$flag==12 ||$flag==13 ||$flag==16 ||$flag==17 ||$flag==18 ||$flag==19 ||$flag==22 ||$flag==23)
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="single-banner banner-top">
                            <a href="{{ $image->image_link }}" target="_blank"><img src="{{ asset('backend/uploads/homeImage/'.$image->home_image) }}" alt="{{ $image->image_alter }}" class="img-fluid"></a>
                        </div>
                    </div>
                @endif
                @if ($flag==2 || $flag==3 ||$flag==8 ||$flag==9 ||$flag==14 ||$flag==15||$flag==20 ||$flag==21)
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="">
                            <div class="single-banner banner-top">
                                <a href="{{ $image->image_link }}" target="_blank"><img src="{{ asset('backend/uploads/homeImage/'.$image->home_image) }}" alt="{{ $image->image_alter }}" class="img-fluid"></a>
                            </div>
                        </div>
                    </div>
                    @endif

                    @php
                        $flag++;
                    @endphp
                    @endforeach

            </div>
        </div>
    </div>
<!-- Category Description Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="faq-content">
                    <div class="faq-desc category-details">
                        {!! $description->description !!}
                    </div>
                </div>
            </div>
        </div>
    <!-- Category Description End -->
    </div>

@endsection

