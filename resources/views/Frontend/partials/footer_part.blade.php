<!--===================
     footer area start
    ===================-->
    <footer class="mt-30 footer_all">
        <!-- Footer Top Start -->
        <div class="footer-top mt-50 " id="strip-contact">
            <div class="str-contact-overlay">
                <div class="container mt5">
                    <div class="row">
                        @foreach (App\ContactUs::where('status', 1)->orderBy('serial', 'ASC')->get() as $contact)
                        <div class="col-md-3 mb-3">
                            <div class="footerhead">
                                <div class="officename text-center">
                                   <a href="{{ $contact->location_map }}" target="_blank"> <h6 class="footer-head-text">{{ $contact->branch_name }}-<i class="fa fa-map-marker"></i></h6></a>
                                </div>
                            </div>
                            <div class="address-1 fobody" id="footer-p">
                                <p class="footer-pera1"  >{!! $contact->address !!}</p>
                            </div>
                            <div class="offon">
                                <p class="footer-pera">{{ $contact->close_day }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <!-- Footer Top End -->


        <!-- Footer Top Start -->
        <section id="footer-part">
            <!-- container Start -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="footer-item follow-part">
                            <div class="follow-title">
                                <h4>FOLLOW US...</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="top icons">
                                        <a class="facebook" href="https://www.facebook.com/originalstorebd" target="_blank"><i class="zmdi zmdi-facebook"></i></a>
                                        <a class="insta" href="https://www.instagram.com/originalstoreltd/" target="_blank"><i class="fa fa-instagram"></i></a>
                                        <a class="youtube" href="https://www.youtube.com/originalstorebd" target="_blank"><i class="zmdi zmdi-youtube-play"></i></a>
                                        <a class="twitter" href="https://twitter.com/originalstorebd" target="_blank"><i class="zmdi zmdi-twitter"></i></a>
                                        <a class="linkedin" href="https://www.linkedin.com/company/originalstorebd" target="_blank"><i class="zmdi zmdi-linkedin"></i></a>
                                        <a class="pinterest" href="https://www.pinterest.com/originalstorebd/" target="_blank"><i class="fa fa-pinterest"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="bottom">
                                        <div class="left">
                                            <a href="#">
                                                <p>info@originalstorebd.com</p>
                                            </a>
                                            <a class="tel:+880 1739 438877" href="">
                                                <p>hotline: +880 1739438877</p>
                                            </a>
                                        </div>
                                        <div class="right">
                                            <a class="{{ count(App\Offer::Offers()->get()) == 0 ? 'offer-button-null' : 'offer-button' }}" href="{{ route('our.offers') }}">Offers</a>
                                            {{-- <a class="service-button"  href="{{ route('our.service') }}">Service</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="footer-item quick-menus pc-view">
                            <ul>
                                <li><a href="{{ route('about.us') }}">About Us</a></li>
                                <li><a href="{{ route('privacy.policy') }}">Privecy Policy</a></li>
                                <li><a href="{{ route('mission.vision') }}">Mission & Vision</a></li>
                                <li><a href="{{ route('terms.condition') }}">Terms & Conditions (Warranty)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-1">
                        <div class="footer-item"></div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="footer-item quick-menus pc-view">
                            <ul class="quick-two">
                                <li><a href="{{ route('return.refund') }}">Return & Refund Policy</a></li>
                                <li><a href="{{ route('emi.policy') }}">EMI Policy</a></li>
                                <li><a href="{{ route('payment.policy') }}">Payment Policy</a></li>
                                <li><a href="{{ route('delivery.policy') }}">Delivery Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-3">
                        <div class="footer-item quick-menus pc-view">
                            <ul>
                                <li><a href="{{ route('job.circular') }}">Job Circular</a></li>
                                <li><a href="{{ route('all.brands') }}">Brands</a></li>
                                <li><a href="{{ route('contact.us') }}">Contact Us</a></li>
                                <li><a href="{{ route('site.map') }}">Sitemap</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row go-middle">
                        <div class="col-6">
                            <div class="footer-item quick-menus mb-view mb-viewtwo">
                                <ul>
                                   <li><a href="{{ route('about.us') }}">About Us</a></li>
                                    <li><a href="{{ route('privacy.policy') }}">Privecy Policy</a></li>
                                    <li><a href="{{ route('mission.vision') }}">Mission & Vision</a></li>
                                    <li><a href="{{ route('terms.condition') }}">Terms & Conditions (Warranty)</a></li>
                                    <li><a href="{{ route('return.refund') }}">Return & Refund Policy</a></li>
                                    <li><a href="{{ route('emi.policy') }}">EMI Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="footer-item quick-menus mb-view">
                                <ul>
                                    <li><a href="{{ route('payment.policy') }}">Payment Policy</a></li>
                                    <li><a href="{{ route('delivery.policy') }}">Delivery Policy</a></li>
                                    <li><a href="{{ route('job.circular') }}">Job Circular</a></li>
                                    <li><a href="{{ route('all.brands') }}">Brands</a></li>
                                    <li><a href="{{ route('contact.us') }}">Contact Us</a></li>
                                    <li><a href="{{ route('site.map') }}">Sitemap</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- container end -->
        </section>
        <!-- Footer Top End -->

        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="footer-bottom-content">
                            <div class="footer-copyright footer_css text-center">
                                <span>Copyright © 2021 <a href="{{ url('/') }}">Original Store Ltd. (Developed by MD Khalid Hosain)</a> All Right Reserved</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->
    </footer>
    <!--===================
     footer area end
    ===================-->
