<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="NAIA Shelter Project">
    <meta name="author" content="Dodynamic.com">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo URL; ?>img/brand/favicon.jpg" type="image/jpeg"/>

    <!-- Title -->
    <title>Log in - Shelter Project</title>

    <!-- Bootstrap css-->
    <link href="<?php echo URL; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Icons css-->
    <link href="<?php echo URL; ?>plugins/web-fonts/icons.css" rel="stylesheet"/>
    <link href="<?php echo URL; ?>plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>plugins/web-fonts/plugin.css" rel="stylesheet"/>

    <!-- Style css-->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/skins.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/dark-style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/colors/default.css" rel="stylesheet">

    <!-- Color css-->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo URL; ?>css/colors/color4.css">

    <!-- Select2 css-->
    <link href="<?php echo URL; ?>plugins/select2/css/select2.min.css" rel="stylesheet">

    <!-- Mutipleselect css-->
    <link rel="stylesheet" href="<?php echo URL; ?>plugins/multipleselect/multiple-select.css">

    <!-- Sidemenu css-->
    <link href="<?php echo URL; ?>css/sidemenu/sidemenu.css" rel="stylesheet">

    <script>
        var appURL = '';
    </script>

</head>

<body class="main-body leftmenu">

<!-- Loader -->
<div id="global-loader">
    <img src="<?php echo URL; ?>img/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- End Loader -->

<!-- Page -->
<div class="page main-signin-wrapper">

    <!-- Row -->
    <div class="row signpages text-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row row-sm">
                    <style>
                        .signpages .details::before, .construction::before {
                            background: #0f395f;
                            opacity: 0.95;
                        }
                    </style>
                    <div class="col-lg-6 col-xl-5 d-none d-lg-block text-center details">
                        <div class="mt-5 pt-4 p-2 pos-absolute" style="width: 95%;">
                            <img src="<?php echo URL; ?>img/brand/logo-light.png" class="header-brand-img mb-4" alt="logo">
                            <div class="clearfix"></div>
                            <img src="<?php echo URL; ?>img/svgs/user.svg" class="ht-100 mb-0" alt="user">
                            <h5 class="mt-4 text-white">Log in Your Account</h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-7 col-xs-12 col-sm-12 login_form ">
                        <div class="container-fluid">
                            <div class="row row-sm">
                                <div class="card-body mt-2 mb-2">
                                    <img src="<?php echo URL; ?>img/brand/logo.png" class=" d-lg-none header-brand-img text-left float-left mb-4" alt="logo">
                                    <div class="clearfix"></div>
                                    <form>
                                        <h5 class="text-left mb-2">Log in to Your Account</h5>
                                        <div class="form-group text-left">
                                            <label>Email</label>
                                            <input name="username" class="form-control" placeholder="Enter your email" type="text">
                                        </div>
                                        <div class="form-group text-left">
                                            <label>Password</label>
                                            <input name="password" class="form-control" placeholder="Enter your password" type="password">
                                        </div>
                                        <span id="login" class="btn ripple btn-main-primary btn-block">Log In</span>

                                        <div id="error-container" style="display:none;" class="alert alert-danger mg-b-0 mt-2" role="alert">
                                            <strong></strong>
                                        </div>
                                    </form>
                                    <div class="text-left mt-5 ml-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Row -->

</div>
<!-- End Page -->

<!-- Jquery js-->
<script src="<?php echo URL; ?>plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap js-->
<script src="<?php echo URL; ?>plugins/bootstrap/js/popper.min.js"></script>
<script src="<?php echo URL; ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Select2 js-->
<script src="<?php echo URL; ?>plugins/select2/js/select2.min.js"></script>

<!-- Custom js -->
<script src="<?php echo URL; ?>js/custom.js"></script>


</body>
</html>