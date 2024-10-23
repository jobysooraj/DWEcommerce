<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ethan Spices</title>
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('theme/website/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/website/common/common.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>

    @include('customer.layouts.header')
    @include('customer.layouts.navigation')
    @yield('content')
    @include('customer.layouts.footer')

    <!-- JS here -->
    <script src="{{ asset('theme/website/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/popper.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/one-page-nav-min.js') }}"></script>
    <script src="{{ asset('theme/website/js/slick.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/ajax-form.js') }}"></script>
    <script src="{{ asset('theme/website/js/fontawesome.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/wow.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('theme/website/js/plugins.js') }}"></script>
    <script src="{{ asset('theme/website/js/main.js') }}"></script>
    @yield('script')
</body>

</html>
