<!DOCTYPE html>
<html>

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>GedhePOS</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('images/logos/logo.png') }}" type="image/x-icon">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/landing/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="css/landing/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/landing/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- font css -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/landing/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
</head>

<body>
    <div class="header_section">
        <!-- banner section start -->
        <div class="banner_section layout_padding">
            <div class="container">
                <div id="banner_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">
                                    <div class="banner_taital_main">
                                        <h1 class="banner_taital">Gedhe POS</h1>
                                        <h5 class="tasty_text">Kasir Cerdas, Bisnis Lebih Mudah</h5>
                                        <p class="banner_text">Transaksi cepat, efisiensi maksimal, dan keuntungan lebih
                                            besar untuk bisnis Anda. </p>
                                        <div class="btn_main">
                                            <div class="about_bt"><a href="{{ route('login') }}">Login</a></div>
                                            <div class="callnow_bt active"><a
                                                    href="{{ route('register') }}">Register</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner section end -->
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
