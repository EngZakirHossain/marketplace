<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('admin') }}/assets" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ setting('site_title') }} | @yield('page_title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets') }}/img/favicon/favicon.ico" />
    @include('admin.layouts.inc.style')
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/css/pages/page-auth.css" />

</head>

<body>
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('admin') }}/assets/img/illustrations/auth-login-illustration-light.png"
                        alt="auth-login-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-login-illustration-light.png"
                        data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

                    <img src="{{ asset('admin') }}/assets/img/illustrations/bg-shape-image-light.png"
                        alt="auth-login-cover" class="platform-bg"
                        data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <img src="{{ asset('storage/uploads/company') }}/{{ setting('site_logo') }}"
                            class="h-auto rounded-circle" id="uploadedAvatar">
                    </div>
                    <!-- /Logo -->
                    <h3 class="mb-1 fw-bold">Welcome to {{ setting('site_title') }}</h3>
                    <p class="mb-4">Please sign-in to your account and start the adventure</p>

                    <form id="formAuthentication" class="mb-3 @error('email') is-invalid @enderror"
                        action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text"
                                class="form-control @error('email') is-invalid   @enderror"
                                id="email" name="email" placeholder="Enter your email" autofocus />
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                <a href="{{ route('password.request') }}">
                                    <small>Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Sign in</button>
                    </form>

                    <div class="divider my-4">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="{{ route('login.provider', ['provider' => 'facebook']) }}"
                            class="btn btn-icon btn-label-facebook me-3">
                            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                        </a>

                        <a href="{{ route('login.provider', ['provider' => 'google']) }}"
                            class="btn btn-icon btn-label-google-plus me-3">
                            <i class="tf-icons fa-brands fa-google fs-5"></i>
                        </a>

                        <a href="{{ route('login.provider', ['provider' => 'github']) }}"
                            class="btn btn-icon btn-label-github">
                            <i class="tf-icons fa-brands fa-github fs-5"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- Core JS -->
    @include('admin.layouts.inc.script')

    <script src="{{ asset('admin') }}/assets/js/pages-auth.js"></script>
</body>

</html>
