<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dealer Honda Semarang</title>
    <meta name="robots" content="{{!empty($is_detail) ? 'noindex, nofollow' : 'index, follow'}}">
    <meta name="googlebot" content="{{!empty($is_detail) ? 'noindex, nofollow' : 'index, follow'}}">
    <meta name="googlebot-news" content="{{!empty($is_detail) ? 'noindex, nofollow' : 'index, follow'}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{!empty($meta_content) ? $meta_content : 'Selamat datang di Dealer Resmi Mobil Honda Jawa Tengah. Coverage area Semarang, Demak, Kudus, Grobogan, Pati, Purwodadi, Kendal, Ambarawa, Pekalongan, Tegal, Batang, Kendal, Solo, Surakarta, Salatiga, Pemalang, Brebes, untuk anda yang ada di area Semarang Jateng lagi mencari Harga Teringan Mobil Honda Brio Di Semarang 2023 maka sahabat Honda datang di tempat yang tepat'}}">
    <meta name="keywords" content="{{!empty($meta_keyword) ? $meta_keyword : 'dealer honda, mobil honda, dealer mobil, honda mobil, honda dealer, dealer honda semarang, honda mobil semarang, dealer semarang, semarang dealer, seamarang, honda dealer'}}">
    <meta name="developer" content="caturilham05.github.io/portfolio">
    <meta name="Author" content="{{url('/')}}">
    <meta name="ROBOTS" content="{{!empty($is_detail) ? 'noindex, nofollow' : 'all, index, follow'}}">


    <!-- Favicon -->
    <link href="{{asset('template/logo/logo-honda.png')}}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;700&family=Ubuntu:wght@400;500&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('template/public/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/public/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('template/public/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('template/public/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('template/public/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    @include('public.components.spinner')
    <!-- Spinner End -->


    <!-- Topbar Start -->
    @include('public.components.header')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    @include('public.components.navbar')
    <!-- Navbar End -->

    @yield('content')
    
    <!-- Footer Start -->
    @include('public.components.footer')
    <!-- Footer End -->

    <!-- Back to Top -->
    @include('public.components.back_to_top')
    @include('cookie-consent::index')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('template/public/lib/wow/wow.min.js')}}"></script>
    <script src="{{asset('template/public/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('template/public/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('template/public/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{asset('template/public/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('template/public/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{asset('template/public/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{asset('template/public/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('template/public/js/main.js')}}"></script>
    @yield('script')
</body>

</html>