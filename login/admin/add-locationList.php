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
            <form action="" method="POST">
              <div class="form-group">
                <label for="usr">Location Name:</label>
                <input type="text" class="form-control" id="location_name" name="location_name" placeholder="Starting PLace Name --- Destination Place Name" required>
              </div>
              <div class="form-group">
                <label for="usr">Price:</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Ticket Price" required>
              </div>
              <button type="submit" class="btn btn-primary" name="loc_submit">Submit</button>
              <a href="view-locationList.php" class="btn btn-warning">View Locations</a>
            </form>
        <br><br>
      </div>
    </section><!-- End Counts Section -->


  </main><!-- End #main -->

 <!-- ======= Footer ======= -->

<?php include "includes/footer.php" ?>
<?php include "includes/js.php" ?>

</body>

</html>


<?php 

  
  if (isset($_POST['loc_submit'])) {
   
      $location_name = $_POST['location_name'];
      $price = $_POST['price'];

      $sql = "INSERT INTO location_table( location_name, price ) VALUES( '$location_name' ,'$price' )";
      if (  mysqli_query($con,$sql)  ){
        ?>
            <script>
              alert('Upload Successfull');
              window.location = 'add-locationList.php';
            </script>
        <?php
      }
      else{
        ?>
            <script>
              alert('Error');
              setTimeout(() => {
                    window.location = 'add-locationList.php';
                }, 500);
            </script>
        <?php
      }
  }

?>