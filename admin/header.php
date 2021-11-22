<?php
 session_start();
 include('db.php');
 include('function.php');
 include("constant.php");

 $uri = $_SERVER['REQUEST_URI'];
 $uri = explode('/',$uri);
 $uri = $uri[count($uri) - 1];
 if(!isset($_SESSION['ADMIN'])){
     header("Location: login.php");
 }
 $title = '';
 if($uri == 'dashboard.php'){
    $title = "Welcome to dashboard";
 }
 elseif($uri == 'category.php'){
    $title = "Category";
 }
 elseif($uri == 'language.php'){
    $title = 'Language';
 }
 elseif($uri == 'books.php'){
    $title = 'Books';
 }
 elseif($uri == 'messages.php'){
     $title = 'Read user messages!';
 }
  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title;?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="sidebar-light">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
                <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
                    <li class="nav-item nav-toggler-item">
                        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </li>

                </ul>
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <!-- <a class="navbar-brand brand-logo" href="dashboard.php"><img src="assets/images/logo.png"
                            alt="logo" /></a> -->
                    <!-- <a class="navbar-brand brand-logo-mini" href="dashboard.php"><img src="assets/images/logo.png"
                            alt="logo" /></a> -->
                </div>
                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <span class="nav-profile-name"><?php echo $_SESSION['ADMIN'];?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">
                                <i class="mdi mdi-logout text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                    <li class="nav-item nav-toggler-item-right d-lg-none">
                        <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="category.php">
                            <i class="mdi mdi-view-headline menu-icon"></i>
                            <span class="menu-title">Category</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="language.php">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Language</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="books.php">
                            <i class="mdi mdi-airplay menu-icon"></i>
                            <span class="menu-title">Books</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="messages.php">
                            <i class="mdi mdi-airplay menu-icon"></i>
                            <span class="menu-title">Messages</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->