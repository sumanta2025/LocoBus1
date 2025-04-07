<?php
    session_start();
    include "../../db.php";

    if ( !isset($_SESSION['uid']) && !isset($_SESSION['uref']) && !isset($_SESSION['utype']) )
        header("Location: logout.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/css.php" ?>
</head>

<body>
<?php include "includes/header.php" ?>


  <main id="main">
    <section class="breadcrumbs"></section>

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">
        <div class="row">
          
            <div class="col-lg-3 col-md-6 mt-5 mt-md-5">
              <div class="count-box">
                <i class="icofont-location-pin"></i>
                <a href="view-locationList.php"><h3>Location</h3></a>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-md-5">
              <div class="count-box">
                <i class="icofont-sub-listing"></i>
                <a href="view-bus.php"><h3>Bus</h3></a>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-5 mt-md-5">
              <div class="count-box">
                <i class="icofont-address-book"></i>
                <a href="view-bookedTicket.php"><h3>Booking List</h3></a>
              </div>
            </div>
        </div>
        <br><br>
      </div>
    </section><!-- End Counts Section -->


  </main><!-- End #main -->

 <!-- ======= Footer ======= -->

<?php include "includes/footer.php" ?>
<?php include "includes/js.php" ?>

</body>

</html>