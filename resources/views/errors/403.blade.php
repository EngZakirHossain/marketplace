<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('admin') }}/assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Not Authorized </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin') }}/assets/img/favicon/favicon.ico" />

    @include('admin.layouts.inc.style')
    <link rel="stylesheet" href="{{ asset('admin') }}/assets/vendor/css/pages/page-misc.css" />

</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Content -->
            <div class="content-wrapper center">
                <!-- Not Authorized -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="misc-wrapper">
                        <h2 class="mb-1 mx-2">You are not authorized!</h2>
                        <p class="mb-4 mx-2">
                            You do not have permission to view this page using the credentials that you have provided
                            while
                            login.
                            <br />
                            Please contact your site administrator.
                        </p>
                        <a href="{{ route('admin.home') }}" class="btn btn-primary mb-4">Back to home</a>
                        <div class="mt-4">
                            <img src="{{ asset('admin') }}/assets/img/illustrations/page-misc-you-are-not-authorized.png"
                                alt="page-misc-not-authorized" width="170" class="img-fluid" />
                        </div>
                    </div>
                </div>
                <div class="container-fluid misc-bg-wrapper">
                    <img src="{{ asset('admin') }}/assets/img/illustrations/bg-shape-image-light.png"
                        alt="page-misc-not-authorized" data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
                <!-- /Not Authorized -->
                </ <!-- / Content -->
            </div>
        </div>

        <!-- Core JS -->
        @include('admin.layouts.inc.script')
        <!-- Page JS -->
</body>

</html>
