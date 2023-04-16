
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Sign In</title>
<!-- Favicon-->
<link rel="icon" href="{{ asset('backend/assets/images/original_store_logo_dark.svg') }}" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('backend/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/css/style.min.css') }}">
</head>

<body class="theme-blush">

<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <form class="card auth_form" action="{{ url('/admin/login') }}" method="POST">
                    @csrf
                    <div class="header">
                        <img class="logo" src="{{ asset('images/e-logo.png') }}" alt="">
                        <h5>Log in</h5>
                    </div>
                    <div class="body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" >
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-danger alert-dismissible" >
                                <strong>{{ session('status') }}</strong>
                                <button type="button" class="close my-3" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="input-group">
                            <input type="text" name="email" class="form-control" placeholder="Email Address">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                         @error ('email')
                            <small class="text-danger">{{ $message }}</small>
                         @enderror
                        <div class="mb-3"></div>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <span class="input-group-text"><a href="forgot-password.html" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>
                        </div>
                        @error ('password')
                            <small class="text-danger">{{ $message }}</small>
                         @enderror
                        <div class="checkbox my-2">
                            <a class="link" href="{{ route('admin-forgot-password') }}">Forget Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SIGN IN</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="card">
                    <img src="{{ asset('backend/assets/images/signin.svg') }}" alt="Sign In"/>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('backend/assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/bundles/vendorscripts.bundle.js') }}"></script> <!-- Lib Scripts Plugin Js -->
</body>
</html>
