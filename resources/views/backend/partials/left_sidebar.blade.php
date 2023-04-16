<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{ url('/') }}" target="#"><img src="{{ asset('images/e-logo.png') }}" width="25" alt="OriginalStore"><span class="m-l-10">Learn Academy</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
{{--                    <a class="image" href="">@if ( Auth::guard('admin')->user()->image !=null ) <img src="{{ asset('backend/uploads/admin') }}/{{ Auth::guard('admin')->user()->image }}" alt="{{ Auth::guard('admin')->user()->name }}"> @else  @endif</a>--}}
                    <div class="detail">
                        <h4>{{ ucwords(auth('admin')->user()->name) }}</h4>
                        <small>{{ ucwords(auth('admin')->user()->type) }}</small>
                    </div>
                </div>
            <li class="@yield('dashboard_active')"><a class="@yield('dashboard_toggled')"href="{{ route('dashboard.index') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
{{--            <li class="@yield('role_management_active')"><a href="javascript:void(0);" class="menu-toggle @yield('role_create_toggled')"><i class="zmdi zmdi-account-circle"></i><span>Role Management</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('role_create_active')"><a class="@yield('role_create_toggled')" href="{{ route('management.index') }}">Create Role</a></li>--}}
{{--                    <li class="@yield('assign_role_active')"><a class="@yield('assign_role_toggled')" href="{{ route('management.user') }}">Assign Role to User</a></li>--}}

{{--                </ul>--}}
{{--            </li>--}}
            <li class="@yield('admin_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('update_details_toggled')"><i class="zmdi zmdi-account"></i><span>Admin Profile</span></a>
                <ul class="ml-menu">
                    <li class="@yield('update_details_active')"><a class="@yield('update_details_toggled')" href="{{ url('/admin/update-details') }}">Update Details</a></li>
                    <li class="@yield('change_pwd_active')"><a class="@yield('change_pwd_toggled')" href="{{ route('admin-settings') }}">Change Password</a></li>
                </ul>
            </li>
            <li class="@yield('category_active')"><a class="@yield('category_toggled')"href="{{ route('course-category.index') }}"><i class="zmdi zmdi-home"></i><span>Course Category</span></a></li>
            <li class="@yield('course_active')"><a class="@yield('course_toggled')"href="{{ route('course.index') }}"><i class="zmdi zmdi-home"></i><span>Course List</span></a></li>
            <li class="@yield('exam_active')"><a class="@yield('exam_toggled')"href="{{ route('exam-event.index') }}"><i class="zmdi zmdi-home"></i><span>Exam List</span></a></li>
            <li class="@yield('requested_active')"><a class="@yield('requested_toggled')"href="{{ route('exam-request') }}"><i class="zmdi zmdi-home"></i><span>Requested Exams<span class="badge" style="color:red; font-size: 20px">{{ App\PaymentDetails::where('exam_confirmation_status', 'pending')->count() }}</span></span></a></li>
            <li class="@yield('exam_result_active')"><a class="@yield('exam_result_toggled')"href="{{route('all-exam-result')}}"><i class="zmdi zmdi-home"></i><span>Exam Result</span><span class="badge" style="color:red; font-size: 20px">{{ App\ExamResult::where('status', 'Pending')->count() }}</span></a></li>
            <li class="@yield('exam_report_active')"><a class="@yield('exam_report_toggled')"href="{{route('exam-report')}}"><i class="zmdi zmdi-home"></i><span>All Reports</span></a></li>
            <li class="@yield('course_review_active')"><a class="@yield('course_review_toggled')"href="{{route('course-review-list')}}"><i class="zmdi zmdi-home"></i><span>All Course Review</span><span class="badge" style="color:red; font-size: 20px">{{ App\CourseReview::where('status', 0)->count() }}</span></a></li>
{{--            <li class="@yield('section_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('section_toggled')"><i class="zmdi zmdi-account"></i><span>Catalogue</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('section_active')"><a class="@yield('section_toggled')" href="{{ url('/admin/section') }}">Section</a></li>--}}
{{--                    <li class="@yield('category_active')"><a class="@yield('category_toggled')" href="{{ url('/admin/categories') }}">Category</a></li>--}}
{{--                    <li class="@yield('brand_active')"><a class="@yield('brand_toggled')" href="{{ url('/admin/brands') }}">Brand</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="@yield('product_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('product_toggled')"><i class="zmdi zmdi-account"></i><span>Product</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('item_type_active')"><a class="@yield('item_type_toggled')" href="{{ url('/admin/product-type') }}">Item Type</a></li>--}}
{{--                    <li class="@yield('item_parts_active')"><a class="@yield('item_parts_toggled')" href="{{ url('/admin/product-type-parts') }}">Item Parts Variant</a></li>--}}
{{--                    <li class="@yield('product_active')"><a class="@yield('product_toggled')" href="{{ url('/admin/products') }}">Product Manage</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="@yield('banner_section_active')"><a href="javascript:void(0);" class="menu-toggle @yield('banner_toggled')"><i class="zmdi zmdi-account"></i><span>Banner Part</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('banner_active')"><a class="@yield('banner_toggled')" href="{{ route('banner-details') }}">Banner Manage</a></li>--}}
{{--                    <li class="@yield('homeImage_active')"><a class="@yield('homeImage_toggled')" href="{{ route('home-image-details') }}">Home Multiple Image</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="@yield('discount_section_active')"><a href="javascript:void(0);" class="menu-toggle @yield('discount_toggled')"><i class="zmdi zmdi-account"></i><span>Manage Discount</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('discount_active')"><a class="@yield('discount_toggled')" href="{{ route('discount-details') }}">Discount</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="@yield('order_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('onlineOrder_toggled') notification"><i class="zmdi zmdi-account"></i><span>Order Manage</span><span class="badge" style="color:white">{{ App\Order::where('status', 'Processing')->count() }}</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('onlineOrder_active')"><a class="@yield('onlineOrder_toggled') notification" href="{{ route('online-order') }}">Online Order<span class="badge" style="color:white">{{ App\Order::where('status', 'Processing')->where('payment_method',1)->count() }}</span></a></li>--}}
{{--                    <li class="@yield('offline_active')"><a class="@yield('offline_toggled') notification" href="{{ route('offline-order') }}">Offline Order<span class="badge" style="color:white">{{ App\Order::where('status', 'Processing')->where('payment_method',2)->count() }}</span></a></li>--}}
{{--                    <li class="@yield('confirmed_active')"><a class="@yield('confirmed_toggled') notification" href="{{ route('confirmd-order') }}">Confirm Order <span class="badge ml-2" style="color:white">{{ App\Order::where('status', 'Confirmed')->where('payment_method',2)->count() }}</span></a></li>--}}
{{--                    <li class="@yield('delivered_active')"><a class="@yield('delivered_toggled')" href="{{ route('delivered-order') }}">Delivered Order</a></li>--}}
{{--                    <li class="@yield('cancelled_active')"><a class="@yield('cancelled_toggled')" href="{{ route('cancelled-order') }}">Cancelled Order</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="@yield('offer_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('offer_toggled')"><i class="zmdi zmdi-account"></i><span>Manage Offers</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('offer_active')"><a class="@yield('offer_toggled')" href="{{ route('all.offer') }}">Offers</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="@yield('component_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('component_toggled')"><i class="zmdi zmdi-account"></i><span>PC Buil Component </span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('component_active')"><a class="@yield('component_toggled')" href="{{ route('pc-build.component') }}">Component</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="@yield('about_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('about_toggled')"><i class="zmdi zmdi-account"></i><span>Information Panel</span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('front_page_active')"><a class="@yield('front_page_toggled')" href="{{ route('front-page-seo') }}">Front Page SEO</a></li>--}}
{{--                    <li class="@yield('scroll_active')"><a class="@yield('scroll_toggled')" href="{{ route('scroll-information') }}">Scroll Bar</a></li>--}}
{{--                    <li class="@yield('about_active')"><a class="@yield('about_toggled')" href="{{ route('about-information') }}">About</a></li>--}}
{{--                    <li class="@yield('privacy_active')"><a class="@yield('privacy_toggled')" href="{{ route('privacy-information') }}">Privacy Policy</a></li>--}}
{{--                    <li class="@yield('missionVision_active')"><a class="@yield('missionVision_toggled')" href="{{ route('mission-vision-information') }}">Mission and Vision</a></li>--}}
{{--                    <li class="@yield('terms_active')"><a class="@yield('terms_toggled')" href="{{ route('terms-conditions') }}">Terms & Conditions</a></li>--}}
{{--                    <li class="@yield('payment_active')"><a class="@yield('payment_toggled')" href="{{ route('payment-policy') }}">Payment Policy</a></li>--}}
{{--                    <li class="@yield('delivery_active')"><a class="@yield('delivery_toggled')" href="{{ route('delivery-policy') }}">Delivery Policy</a></li>--}}
{{--                    <li class="@yield('returnRefund_active')"><a class="@yield('returnRefund_toggled')" href="{{ route('return-refund-information') }}">Return and Refund Policy</a></li>--}}
{{--                    <li class="@yield('emi_active')"><a class="@yield('emi_toggled')" href="{{ route('emi-information') }}">EMI Conditions</a></li>--}}
{{--                    <li class="@yield('jobCircular_active')"><a class="@yield('jobCircular_toggled')" href="{{ route('job-circular-information') }}">Job Circular</a></li>--}}
{{--                    <li class="@yield('contact_active')"><a class="@yield('contact_toggled')" href="{{ route('contact-information') }}">Contact Page</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
{{--            <li class="@yield('review_settings_active')"><a href="javascript:void(0);" class="menu-toggle @yield('review_toggled') notification"><i class="zmdi zmdi-account"></i><span>Feedback <span class="badge" style="color:white" id="noti_number">{{ question_acomment_count() }}</span></span></a>--}}
{{--                <ul class="ml-menu">--}}
{{--                    <li class="@yield('review_active')"><a class="@yield('review_toggled') notification" href="{{ route('user.review.list') }}">Review <span class="badge" style="color:white">{{ App\Review::where('status', 0)->count() }}</span></a></li>--}}
{{--                    <li class="@yield('question_active')"><a class="@yield('review_toggled') notification" href="{{ route('all.question') }}">Question <span class="badge" style="color:white">{{ App\UserQuestion::where('answer', null)->count() }}</span></a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}

        </ul>
    </div>
</aside>





