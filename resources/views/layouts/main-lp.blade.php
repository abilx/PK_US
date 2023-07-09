<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/logo/logo-icon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-icon.png') }}" type="image/x-icon">
    <title>Website Kelurahan Umban Sari</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    @include('partials.lp.css')

    <script type="text/javascript" src="http://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=TerUiB_JhZUavjtKChLRRCCf61w7to53myUlSoTMoYcVmZQs85NKwDlIVI8ehdla6YziXDUs4vfTidUfAygo70RWUWKNjmXoj5FA1dJKpQA" charset="UTF-8"></script>
</head>

<body class="landing-wrraper">
    <!-- tap on top starts-->
    <div class="tap-top">
        <i data-feather="chevrons-up"></i>
    </div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper landing-page">
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <div class="page-wrapper compact-header" id="pageWrapper">
            @includeIf('partials.lp.header')
            <section class="unique-cards section-py-space">
                <div class="page-body-wrapper header-icon">
                @include('sweetalert::alert')
                <!-- Container-fluid starts-->
                @yield('container')
                <!-- Container-fluid Ends-->
                </div>
            </section>
            <div class="sub-footer" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/images/landing/background.jpg'); background-size: cover;">
                <div class="custom-container">
                    <div class="row">
                        {{-- <div class="col-md-6 col-sm-2">
                            <div class="footer-contain"><img class="img-fluid" src="{{ asset('assets/images/logo/logofix5.png') }}" alt=""></div>
                        </div> --}}
                        <div class="col-lg-4">
                            <div class="footer-contain">
                                <p class="m-0 text-center text-white">Copyright
                                    {{ date('Y') }}-{{ date('y', strtotime('+1 year')) }}
                                    © Politeknik Caltex Riau.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    @includeIf('partials.lp.js')
</body>
</html>
