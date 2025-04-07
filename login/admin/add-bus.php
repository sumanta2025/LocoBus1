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

    <!-- ======= Services Section ======= -->
    <section id="services" class="services mt-5">
      <div class="container">

        <div class="section-title">
          <h2>Add Bus Details</h2>
        </div>

          <form action="" method="POST">
              <div class="form-group">
                <label for="bus_name">Bus Name:</label>
                <input type="text" class="form-control" id="bus_name" name="bus_name" required>
              </div>
              <div class="form-group">
                <label for="route">Bus Route:</label>
                <input type="text" class="form-control" id="route" name="route" required>
              </div>
              <div class="form-group">
                <label for="btime">Starting Time:</label>
                <input type="time" class="form-control" id="btime" name="btime" required>
              </div>
               <div class="form-group">
                <label for="week">Week:</label>
                <input type="text" class="form-control" id="week" name="week" required>
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
              <a href="view-bus.php" class="btn btn-warning">View Details</a>
          </form>

      </div>
    </section><!-- End Services Section -->



  </main><!-- End #main -->

<?php include "includes/footer.php" ?>
<?php include "includes/js.php" ?>


</body>

</html>



<?php 

  
  if (isset($_POST['submit'])) {
   
      $bus_name = $_POST['bus_name'];
      $route = $_POST['route'];
      $btime = $_POST['btime'];
      $week = $_POST['week'];


      $sql = "INSERT INTO bus_table(bus_name, route, btime, week) VALUES('$bus_name', '$route', '$btime', '$week')";

      
      if (  mysqli_query($con,$sql)  ){
        ?>
            <script>
              alert('Upload Successfull');
              window.location = 'add-bus.php';
            </script>
        <?php
      }
      else{
        ?>
            <script>
              alert('Error');
              setTimeout(() => {
                    window.location = 'add-bus.php';
                }, 500);
            </script>
        <?php
      }
  }

?>