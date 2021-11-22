<?php
session_start();
include("db.php");
include("function.php");
$msg = 0;
if(isset($_SESSION['ADMIN'])){
    redirect('dashboard.php');
}
if(isset($_POST['submit'])){
    $email = get_safe_value($_POST['email']);
    $password = get_safe_value($_POST['password']);

    $res = mysqli_query($con, "select * from admin where email = '$email' and password = '$password'");
    if(mysqli_num_rows($res)){
        // echo "U are logged in";
        $row = mysqli_fetch_assoc($res);
        $_SESSION['ADMIN'] = $row['name'];
        header("Location: dashboard.php");
    }else{
        $msg = 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel for Downloading PDF</title>
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
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center">
                                <!-- <img src="assets/images/logo.png" alt="logo"> -->
                            </div>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        name="submit">SIGN IN</button>
                                </div>

                            </form>
                            <?php 
                            // echo $msg;
                            if($msg){
                                $str = "<script>
                                alert('Try again');
                                </script>";
                                echo $str;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- plugins:js -->
    <script src="assets/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/template.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>