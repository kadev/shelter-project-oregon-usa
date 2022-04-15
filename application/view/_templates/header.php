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
        <?php if(isset($title)): ?>
            <title><?php echo $title; ?> - Shelter Project</title>
        <?php else: ?>
            <title>Shelter Project - NAIA</title>
        <?php endif; ?>
        <!-- Bootstrap css-->
        <link href="<?php echo URL; ?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>

        <!-- Internal Sweet Alert css-->
        <link href="<?php echo URL; ?>plugins/sweet-alert/sweetalert.css" rel="stylesheet">

        <!-- Internal Summernote css
        <link rel="stylesheet" href="<?php echo URL; ?>plugins/summernote/summernote-bs4.css">-->

        <!-- Icons css-->
        <link href="<?php echo URL; ?>plugins/web-fonts/icons.css" rel="stylesheet"/>
        <link href="<?php echo URL; ?>plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>plugins/web-fonts/plugin.css" rel="stylesheet"/>

        <?php if(isset($datatables) AND $datatables === true): ?>
            <!-- Internal DataTables css-->
            <link href="<?php echo URL; ?>plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />
            <link href="<?php echo URL; ?>plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
        <?php endif; ?>

        <?php if(isset($fileexport) AND $fileexport === true): ?>
            <link href="<?php echo URL; ?>plugins/datatable/fileexport/buttons.bootstrap4.min.css" rel="stylesheet" />
        <?php endif; ?>

        <!-- Style css-->
        <link href="<?php echo URL; ?>css/style.min.css" rel="stylesheet">
        <link href="<?php echo URL; ?>css/skins.css" rel="stylesheet">
        <link href="<?php echo URL; ?>css/dark-style.css" rel="stylesheet">
        <link href="<?php echo URL; ?>css/colors/default.css" rel="stylesheet">

        <!-- Color css-->
        <link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo URL; ?>css/colors/color4.css">

        <!-- Select2 css-->
        <link href="<?php echo URL; ?>plugins/select2/css/select2.min.css" rel="stylesheet">

        <?php if(isset($custom_css)): ?>
            <?php if(is_array($custom_css)): ?>
                <?php foreach ($custom_css as $css): ?>
                    <link href="<?php echo $css; ?>" rel="stylesheet">
            <?php endforeach; ?>
            <?php else: ?>
                <link href="<?php echo $custom_css; ?>" rel="stylesheet">
            <?php endif; ?>
        <?php endif; ?>

        <!-- Mutipleselect css
        <link rel="stylesheet" href="<?php echo URL; ?>plugins/multipleselect/multiple-select.css">-->

        <!-- Sidemenu css-->
        <link href="<?php echo URL; ?>css/sidemenu/sidemenu.css" rel="stylesheet">
        <script>
            var appURL = '<?php echo URL; ?>';
        </script>
        <style>
            .form-control{

            }

            /*.form-control::placeholder{
                color: #495057 !important;
                opacity: 0 !important;
            }*/

            .sidemenu-label {
                font-weight: 600 !important;
            }
        </style>
    </head>

    <body class="main-body leftmenu">
    <!-- Loader
    <div id="global-loader-">
        <img src="<?php echo URL; ?>img/loader.svg" class="loader-img" alt="Loader">
    </div>
     End Loader -->


    <!-- Page -->
    <div class="page">

        <!-- Sidemenu -->
        <div class="main-sidebar main-sidebar-sticky side-menu">
            <div class="sidemenu-logo">
                <a class="main-logo" href="<?php echo URL; ?>">
                    <img src="<?php echo URL; ?>img/brand/logo-light.png" class="header-brand-img desktop-logo" alt="logo">
                    <img src="<?php echo URL; ?>img/brand/logo-icon.jpg" class="header-brand-img icon-logo" alt="logo">
                    <img src="<?php echo URL; ?>img/brand/logo.png" class="header-brand-img desktop-logo theme-logo" alt="logo">
                    <img src="<?php echo URL; ?>img/brand/icon.png" class="header-brand-img icon-logo theme-logo" alt="logo">
                </a>
                <a href="https://localtestserver.com/shelterproject" class="btn btn-light btn-sm w-100 mt-2" target="_blank">View website</a>
            </div>
            <div class="main-sidebar-body">
                <ul class="nav">
                    <li class="nav-header"><span class="nav-label">Dashboard</span></li>
                    <li class="nav-item <?php echo ($current_page == 'dashboard') ? 'active show':''; ?>">
                        <a class="nav-link" href="<?php echo URL; ?>home/dashboard">
                            <span class="shape1"></span>
                            <span class="shape2"></span>
                            <i class="ti-home sidemenu-icon"></i>
                            <span class="sidemenu-label">Dashboard</span>
                        </a>
                    </li>

                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                        <li class="nav-item <?php echo ($current_page == 'pages' OR $current_page == 'create-page') ? 'active show':''; ?>">
                            <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="ti-desktop sidemenu-icon"></i><span class="sidemenu-label">Pages</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="nav-sub">
                                <li class="nav-sub-item <?php echo ($current_page == 'create-page') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>pages/create">Create Page</a>
                                </li>
                                <li class="nav-sub-item <?php echo ($current_page == 'pages') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>pages">Manage Page</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                    <li class="nav-item <?php echo ($current_page == 'articles' OR $current_page == 'create-article') ? 'active show':''; ?>">
                        <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="ti-receipt sidemenu-icon"></i><span class="sidemenu-label">News Articles</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="nav-sub">
                            <li class="nav-sub-item <?php echo ($current_page == 'create-article') ?'active':''; ?>">
                                <a class="nav-sub-link" href="<?php echo URL; ?>articles/create">Create Article</a>
                            </li>
                            <li class="nav-sub-item <?php echo ($current_page == 'articles') ?'active':''; ?>">
                                <a class="nav-sub-link" href="<?php echo URL; ?>articles">Manage Article</a>
                            </li>
                        </ul>
                    </li>
                    <? endif; ?>

                    <?php if($session['privilege'] != 4): ?>
                        <li class="nav-item <?php echo ($current_page == 'shelters' OR $current_page == 'create-shelter' OR $current_page == 'shelter-report' OR $current_page == 'shelter-updates' OR $current_page == 'backup-details') ? 'active show':''; ?>">
                            <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="ti-heart sidemenu-icon"></i><span class="sidemenu-label">Shelters <?php echo ($current_page != 'shelters' AND $current_page != 'create-shelter' AND $current_page != 'shelter-report' AND $current_page != 'shelter-updates' AND $current_page != 'backup-details') ? \Mini\Libs\Helper::getBadgeForAmountShelterUpdates(): ''; ?> </span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="nav-sub">
                                <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                                    <li class="nav-sub-item <?php echo ($current_page == 'create-shelter') ?'active':''; ?>">
                                        <a class="nav-sub-link" href="<?php echo URL; ?>shelters/create">Create Shelter</a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-sub-item <?php echo ($current_page == 'shelters') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>shelters">Manage Shelter</a>
                                </li>
                                <li class="nav-sub-item <?php echo ($current_page == 'shelter-updates') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>shelters/updates">Shelter Updates <?php echo \Mini\Libs\Helper::getBadgeForAmountShelterUpdates(); ?></a>
                                </li>
                                <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                                    <li class="nav-sub-item <?php echo ($current_page == 'shelter-report') ?'active':''; ?>">
                                        <a class="nav-sub-link" href="<?php echo URL; ?>shelters/report">Shelter Report</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                        <li class="nav-item <?php echo ($current_page == 'rescues' OR $current_page == 'create-rescue') ? 'active show':''; ?>">
                            <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="ti-home sidemenu-icon"></i><span class="sidemenu-label">Rescues <?php echo ($current_page != 'rescues' AND $current_page != 'create-rescue') ? '': ''; ?> </span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="nav-sub">
                                <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                                    <li class="nav-sub-item <?php echo ($current_page == 'create-rescue') ?'active':''; ?>">
                                        <a class="nav-sub-link" href="<?php echo URL; ?>rescues/create">Create Rescue</a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-sub-item <?php echo ($current_page == 'rescues') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>rescues">Manage Rescues</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2 OR $session['privilege'] == 4): ?>
                        <li class="nav-item <?php echo ($current_page == 'animal-data' OR $current_page == 'manage-updates' OR $current_page == 'animal-data-send-update') ? 'active show':''; ?>">
                            <a class="nav-link with-sub" href="#">
                                <span class="shape1"></span><span class="shape2"></span><i class="ti-stats-up sidemenu-icon"></i>
                                <span class="sidemenu-label">Animal Data</span><i class="angle fe fe-chevron-right"></i>
                            </a>
                            <ul class="nav-sub">
                                <?php if($session['privilege'] == 4): ?>
                                    <li class="nav-sub-item <?php echo ($current_page == 'animal-data-send-update') ?'active':''; ?>">
                                        <a class="nav-sub-link" href="<?php echo URL; ?>animalData/send-update">Send update</a>
                                    </li>
                                <?php else: ?>
                                    <li class="nav-sub-item <?php echo ($current_page == 'animal-data') ?'active':''; ?>">
                                        <a class="nav-sub-link" href="<?php echo URL; ?>animalData">Manage Data</a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-sub-item <?php echo ($current_page == 'manage-updates') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>animalData/updates">Manage Updates</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                        <li class="nav-item <?php echo ($current_page == 'reports' OR $current_page=='predictive-charts' OR $current_page=='dogs-report' OR $current_page=='cats-report' OR $current_page=='shelters-report' OR $current_page=='reports-created' OR $current_page == 'new-report' OR $current_page == 'edit-report' OR $current_page == 'report-details') ? 'active show':''; ?>">
                            <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="ti-bar-chart sidemenu-icon"></i><span class="sidemenu-label">Reports</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="nav-sub">
                                <li class="nav-sub-item <?php echo ($current_page == 'reports-created' OR $current_page == 'new-report' OR $current_page == 'edit-report' OR $current_page == 'report-details') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>reports/created">Reports Created</a>
                                </li>
                                <li class="nav-sub-item <?php echo ($current_page == 'reports' OR $current_page == 'dogs-report' OR $current_page == 'cats-report') ?'active show':''; ?>">
                                    <a class="nav-sub-link with-sub pr-4" href="#"><span class="w-100">General Reports</span></a>
                                    <ul class="nav-sub">
                                        <li class="nav-sub-item <?php echo ($current_page == 'reports') ?'active':''; ?>">
                                            <a class="nav-sub-link" href="<?php echo URL; ?>reports">All Reports</a>
                                        </li>
                                        <li class="nav-sub-item <?php echo ($current_page == 'dogs-report') ?'active':''; ?>">
                                            <a class="nav-sub-link" href="<?php echo URL; ?>reports/animal-report/dogs">Dogs Report</a>
                                        </li>
                                        <li class="nav-sub-item <?php echo ($current_page == 'cats-report') ?'active':''; ?>">
                                            <a class="nav-sub-link" href="<?php echo URL; ?>reports/animal-report/cats">Cats Report</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-sub-item <?php echo ($current_page == 'predictive-charts') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>reports/predictive">Predictive charts</a>
                                </li>
                                <li class="nav-sub-item <?php echo ($current_page == 'shelters-report') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>reports/sheltersv2">Shelters Report</a>
                                </li>

                                <li class="nav-sub-item <?php echo ($current_page == 'shelters-report') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>reports/sheltersv3">Shelters Report v3</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>


                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                    <li class="nav-item <?php echo ($current_page == 'users' OR $current_page == 'create-user') ? 'active show':''; ?>">
                        <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="ti-user sidemenu-icon"></i><span class="sidemenu-label">Users</span><i class="angle fe fe-chevron-right"></i></a>
                        <ul class="nav-sub">
                            <li class="nav-sub-item <?php echo ($current_page == 'create-user') ?'active':''; ?>">
                                <a class="nav-sub-link" href="<?php echo URL; ?>users/create">Create User</a>
                            </li>
                            <li class="nav-sub-item <?php echo ($current_page == 'users') ?'active':''; ?>">
                                <a class="nav-sub-link" href="<?php echo URL; ?>users">Manage User</a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                        <li class="nav-item <?php echo ($current_page == 'parameters' OR $current_page == 'states' OR $current_page == 'countries' OR $current_page == 'counties' OR $current_page == 'animals') ? 'active show':''; ?>">
                            <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="ti-view-list-alt sidemenu-icon"></i><span class="sidemenu-label">Parameters</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="nav-sub">
                                <li class="nav-sub-item <?php echo ($current_page == 'animals') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>animals">Animals</a>
                                </li>
                                <li class="nav-sub-item <?php echo ($current_page == 'counties') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>counties">Counties</a>
                                </li>
                                <li class="nav-sub-item <?php echo ($current_page == 'countries') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>countries">Countries</a>
                                </li>
                                <li class="nav-sub-item <?php echo ($current_page == 'states') ?'active':''; ?>">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>states">States</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if($session['privilege'] == 1 OR $session['privilege'] == 2): ?>
                        <li class="nav-item <?php echo ($current_page == 'custom-content') ? 'active show':''; ?>">
                            <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span><i class="ti-tag sidemenu-icon"></i><span class="sidemenu-label">Custom Content</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="nav-sub">
                                <li class="nav-sub-item">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>customContent/create">Create Content</a>
                                </li>
                                <li class="nav-sub-item">
                                    <a class="nav-sub-link" href="<?php echo URL; ?>customContent">Manage Content</a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <!-- End Sidemenu -->

        <!-- Main Header-->
        <div class="main-header side-header sticky d-print-none">
            <div class="container-fluid" style="z-index: 1000000;">
                <div class="main-header-left">
                    <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
                </div>
                <div class="main-header-center">
                    <div class="responsive-logo">
                        <a href="index.html"><img src="<?php echo URL; ?>img/brand/logo.png" class="mobile-logo" alt="logo" height="50px"></a>
                        <a href="index.html"><img src="<?php echo URL; ?>img/brand/logo-light.png" class="mobile-logo-dark" height="50px" alt="logo"></a>
                    </div>
                    <div class="input-group">
                        <div class="input-group-btn search-panel">
                            <select id="i-search-categorie" class="form-control select2-no-search" >
                                <option selected label="All categories" value="all">
                                    All Categories
                                </option>
                                <option value="shelters">
                                    Shelters
                                </option>
                                <option value="articles">
                                    Articles
                                </option>
                                <option value="pages">
                                    Pages
                                </option>
                            </select>
                        </div>
                        <input id="i-main-search" type="search" class="form-control" placeholder="Search for anything...">
                        <button id="main-search" class="btn search-btn"><i class="fe fe-search"></i></button>
                    </div>
                </div>
                <div class="main-header-right">

                    <div class="dropdown d-md-flex">
                        <a class="nav-link icon full-screen-link" href="">
                            <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                            <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                        </a>
                    </div>

                    <div class="dropdown main-profile-menu">
                        <a class="d-flex" href="">
                            <span class="main-img-user" ><img alt="avatar" src="<?php echo URL; ?>img/users/1.png"></span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="header-navheading">
                                <h6 class="main-notification-title"><?php echo $session['name']; ?></h6>
                                <?php if($session['username'] == 'admin@dodynamic.com'): ?>
                                    <p class="main-notification-text">Web Administrator</p>
                                <?php elseif($session['privilege'] == 2): ?>
                                    <p class="main-notification-text">Administrator</p>
                                <?php elseif($session['privilege'] == 3): ?>
                                    <p class="main-notification-text">Shelter Editor</p>
                                <?php endif; ?>
                            </div>
                            <a class="dropdown-item border-top" href="<?php echo URL; ?>users/profile">
                                <i class="fe fe-user"></i> My Profile
                            </a>
                            <a class="dropdown-item" href="<?php echo URL; ?>support">
                                <i class="fe fe-settings"></i> Support
                            </a>
                            <a class="dropdown-item" href="<?php echo URL; ?>users/activity">
                                <i class="fe fe-compass"></i> Activity Log
                            </a>
                            <a class="dropdown-item" href="<?php echo URL; ?>users/logout">
                                <i class="fe fe-power"></i> Logout
                            </a>
                        </div>
                    </div>
                    <button class="navbar-toggler navresponsive-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                            aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                    </button><!-- Navresponsive closed -->
                </div>
            </div>
        </div>
        <!-- End Main Header-->

        <!-- Mobile-header -->
        <div class="mobile-main-header">
            <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="dropdown header-search">
                            <a class="nav-link icon header-search">
                                <i class="fe fe-search header-icons"></i>
                            </a>
                            <div class="dropdown-menu">
                                <div class="main-form-search p-2">
                                    <div class="input-group">
                                        <div class="input-group-btn search-panel">
                                            <select id="i-search-categorie-mob" class="form-control select2-no-search" >
                                                <option selected label="All categories" value="all">
                                                    All Categories
                                                </option>
                                                <option value="shelters">
                                                    Shelters
                                                </option>
                                                <option value="articles">
                                                    Articles
                                                </option>
                                                <option value="pages">
                                                    Pages
                                                </option>
                                            </select>
                                        </div>
                                        <input id="i-main-search-mob" type="search" class="form-control" placeholder="Search for anything...">
                                        <button id="main-search-mob" class="btn search-btn"><i class="fe fe-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown main-profile-menu ml-auto mr-4">
                            <a class="d-flex" href="#">
                                <span class="main-img-user" ><img alt="avatar" src="<?php echo URL; ?>img/users/1.png"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="header-navheading">
                                    <h6 class="main-notification-title"><?php echo $session['name']; ?></h6>
                                    <?php if($session['username'] == 'admin@dodynamic.com'): ?>
                                        <p class="main-notification-text">Web Administrator</p>
                                    <?php else: ?>
                                        <p class="main-notification-text">Administrator</p>
                                    <?php endif; ?>
                                </div>
                                <a class="dropdown-item border-top" href="<?php echo URL; ?>users/profile">
                                    <i class="fe fe-user"></i> My Profile
                                </a>
                                <a class="dropdown-item" href="<?php echo URL; ?>support">
                                    <i class="fe fe-settings"></i> Support
                                </a>
                                <a class="dropdown-item" href="<?php echo URL; ?>activity">
                                    <i class="fe fe-compass"></i> Activity Log
                                </a>
                                <a class="dropdown-item"  href="<?php echo URL; ?>users/logout">
                                    <i class="fe fe-power"></i> Sign Out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile-header closed -->
