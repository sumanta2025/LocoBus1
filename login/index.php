<?php
    session_start();
    ob_start();
    include "../db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top" style="margin-top: 0;">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="../index.php">LOCO BUS</a>
        <br><span style="font-size:18px;color: #e6eeff;">Online Local Bus Ticket Booking System</span>
      </h1>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="">Login</a></li>

        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->


  <main id="main">
    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs"></section>
   
   <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="section-title">
          <h2>Login</h2>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-3"></div>
          <div class="col-lg-6 mt-lg-0">
            <form method="POST" action="">

                <div class="form-group">
                  <input type="text" class="form-control" id="userid" name="userid" placeholder="Enter Userid" required>
                </div>

                <div class="form-group">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>

                <div class="text-center"><button type="submit" class="btn btn-primary" name="login_button">Login</button></div>

            </form>

          </div>

          <div class="col-lg-3"></div>

        </div>

      </div>
    </section><!-- End Contact Section -->
  

  </main><!-- End #main -->

 <!-- ======= Footer ======= -->
 <!-- <footer id="footer" style="position: fixed;left: 0;bottom: 0;width: 100%;">

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span></span></strong>. All Rights Reserved
        </div>
      </div>
    </div>
  </footer>-->
  <!-- End Footer -->
  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="../assets/vendor/counterup/counterup.min.js"></script>
  <script src="../assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>


<?php 

if(isset($_POST['login_button'])) {


    $userid = mysqli_real_escape_string($con, strip_tags($_POST['userid']));
    $password = mysqli_real_escape_string($con, strip_tags($_POST['password']));

    $l_sql = "SELECT * FROM users WHERE userid = '$userid'";
    $l_run = mysqli_query($con, $l_sql);
    if ($l_rows = mysqli_fetch_assoc($l_run)) {
     
            $uidDB = $l_rows['uid'];
            $unameDB = $l_rows['uname'];
            $useridDB = $l_rows['userid'];
            $passwordDB = $l_rows['password'];
            $utypeDB = $l_rows['utype'];
            $urefDB = $l_rows['uref'];


          if ($userid == $useridDB) {

              if ($password == $passwordDB) {

                  $_SESSION["uid"] = $uidDB;
                  $_SESSION["utype"] = $utypeDB;
                  $_SESSION["uname"] = $unameDB;
                  $_SESSION["uref"] = $urefDB;

                  if ( $utypeDB == 'admin' ) {
                      header("location:admin/");
                      exit();
                  }
              }
              else {
                  ?>
                  <script>
                      alert("Wrong Password");
                  </script>
                  <?php
              }
          }
          else {
              ?>
              <script>
                  alert("No acount Found");
              </script>
              <?php
          }
    }
}
 
ob_end_flush();
?>