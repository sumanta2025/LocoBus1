<?php
    session_start();
    include "../../db.php";

    if ( !isset($_SESSION['uid']) && !isset($_SESSION['uref']) && !isset($_SESSION['utype']) )
        header("Location: logout.php");

    $edit_sql = "SELECT * FROM location_table WHERE id = '$_GET[eid]'";
    $edit_result = mysqli_query($con,$edit_sql);
    $edit_row = mysqli_fetch_assoc($edit_result);
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
                <input type="text" class="form-control" id="location_name" name="location_name" value="<?php echo $edit_row['location_name']; ?>" required>
              </div>
              <div class="form-group">
                <label for="usr">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $edit_row['price']; ?>" required>
              </div>
              <button type="submit" class="btn btn-primary" name="loc_update">Update</button>
              <a href="view-locationList.php" class="btn btn-warning">Back</a>
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

  
  if (isset($_POST['loc_update'])) {
   
      $location_name = $_POST['location_name'];
      $price = $_POST['price'];

      $sql = "UPDATE location_table SET  location_name = '$location_name', price = '$price' WHERE id= '$_GET[eid]'";

      
      if (  mysqli_query($con,$sql)  ){
        ?>
            <script>
              alert('Update Successfull');
              window.location = 'view-locationList.php';
            </script>
        <?php
      }
      else{
        ?>
            <script>
              alert('Error');
              setTimeout(() => {
                    window.location = 'view-locationList.php';
                }, 500);
            </script>
        <?php
      }
  }

?>