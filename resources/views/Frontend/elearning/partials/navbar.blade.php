<section class="menu-area">
    <div class="container-xl">
        <div class="row">
            <div class="col">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">

                    <ul class="mobile-header-buttons">
                        <li><a class="mobile-nav-trigger" href="#mobile-primary-nav">Menu<span></span></a></li>
                        <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
                    </ul>

                    <a class="navbar-brand" href="/">
                        {{--<img src="" alt="" height="30">--}}
                        Learn Academy
                    </a>

                    @include('Frontend.elearning.partials.menu')

                    <form class="inline-form" action="{{route('search-course')}}"
                          method="GET" style="width: 100%;">
                        <div class="input-group search-box mobile-search">
                            <input type="text" name='search_string' class="form-control"
                                   placeholder="Search for courses">
                            <div class="input-group-append">
                                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="wishlist-box menu-icon-box" id="wishlist_items">
                        {{--Wishlist will be here--}}
                    </div>

                    <div class="cart-box menu-icon-box" id="cart_items">
{{--                        @include('Frontend.elearning.partials.cart')--}}
                        <h5><a href="{{route('all-exam-list')}}">Exams</a></h5>
                    </div>

                    @if(Auth::guard('student')->check())
                        <div class="user-box menu-icon-box">
                            <div class="icon">
                                <a href="">
                                    <img src="{{ asset('images/avatar.png') }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="dropdown user-dropdown corner-triangle top-right">
                                <ul class="user-dropdown-menu">

{{--                                    <li class="dropdown-user-info">--}}
{{--                                        <a href="">--}}
{{--                                            <div class="clearfix">--}}
{{--                                                <div class="user-image float-left">--}}
{{--                                                    <img src="{{ asset('images/avatar.png') }}" alt=""--}}
{{--                                                         class="img-fluid">--}}
{{--                                                </div>--}}
{{--                                                <div class="user-details">--}}
{{--                                                    <div class="user-name">--}}
{{--                                                        <span class="hi">hi,</span>--}}
{{--                                                        <?php echo auth()->user()->first_name . ' ' . auth()->user()->last_name ?>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="user-email">--}}
{{--                                                        <span class="email">{{ auth()->user()->email }}</span>--}}
{{--                                                        <span class="welcome">Welcome back</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
                                    <li class="dropdown-user-info">
                                        <a href="">
                                            <div class="clearfix">
                                                <div class="user-image float-left">
                                                    <img src="{{ asset('images/avatar.png') }}" alt=""
                                                         class="img-fluid">
                                                </div>
                                                <div class="user-details">
                                                    <div class="user-name">
                                                        <span class="hi">hi,</span>{{ Auth::guard('student')->user()->first_name ." ". Auth::guard('student')->user()->last_name }}
                                                    </div>
                                                    <div class="user-email">
                                                        <span class="email">{{ Auth::guard('student')->user()->email }}</span>
                                                        <span class="welcome">Welcome back</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="user-dropdown-menu-item">
                                        <a href="{{route('student-courses')}}">
                                            <i class="far fa-gem"></i>My Courses
                                        </a>
                                    </li>
                                    <li class="user-dropdown-menu-item">
                                        <a href="{{route('student-exams')}}">
                                            <i class="far fa-heart"></i>My Exams
                                        </a>
                                    </li>
                                    <li class="user-dropdown-menu-item">
                                        <a href="{{route('student-profile')}}">
                                            <i class="fas fa-user"></i>User profile
                                        </a>
                                    </li>
{{--                                    <li class="dropdown-user-logout user-dropdown-menu-item">--}}
{{--                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">Logout</a>--}}

{{--                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"--}}
{{--                                              style="display: none;">--}}
{{--                                            @csrf--}}
{{--                                        </form>--}}
{{--                                    </li> --}}
                                    <li class="dropdown-user-logout user-dropdown-menu-item">
                                        <a href="{{ route('student-logout') }}" >Logout</a>

{{--                                        <form id="logout-form" action="{{ route('student-logout') }}" method="POST"--}}
{{--                                              style="display: none;">--}}
{{--                                            @csrf--}}
{{--                                        </form>--}}
                                    </li>
                                </ul>
                            </div>
                        </div>

                    @else

                        <span class="signin-box-move-desktop-helper"></span>
                        <div class="sign-in-box btn-group">

                            <a href="{{url('login/students')}}"><button type="button" class="btn btn-sign-in" >Login</button></a>

                            <a class="text-decoration-none" href="{{route('student.index')}}"><button type="button" class="btn btn-sign-up" >Sign up</button></a>

                        </div>
                    @endif

                </nav>
            </div>
        </div>
    </div>
</section>
