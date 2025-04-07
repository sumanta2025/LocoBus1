<?php
    session_start();
    include "../../db.php";
    
    if ( !isset($_SESSION['uid']) && !isset($_SESSION['uref']) && !isset($_SESSION['utype']) )
        header("Location: logout.php");

    $edit_sql = "SELECT * FROM bus_table WHERE id = '$_GET[eid]'";
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

    <!-- ======= Services Section ======= -->
    <section id="services" class="services mt-5">
      <div class="container">

        <div class="section-title">
          <h2>Edit Location & Price</h2>
        </div>

          <form action="" method="POST">
              <div class="form-group">
                <label for="bus_name">Bus Name:</label>
                <input type="text" class="form-control" id="bus_name" name="bus_name" value="<?php echo $edit_row['bus_name']; ?>" required>
              </div>
              
              <div class="form-group">
                <label for="route">Bus Route:</label>
                <input type="text" class="form-control" id="route" name="route" value="<?php echo $edit_row['route']; ?>" required>
              </div>
              <div class="form-group">
                <label for="btime">Starting Time:</label>
                <input type="time" class="form-control" id="btime" name="btime" value="<?php echo $edit_row['btime']; ?>" required>
              </div>
               <div class="form-group">
                <label for="week">Week:</label>
                <input type="text" class="form-control" id="week" name="week" value="<?php echo $edit_row['week']; ?>" required>
              </div>
              <button type="submit" class="btn btn-primary" name="update">Update</button>
              <a href="view-ticket.php" class="btn btn-warning">Back</a>
          </form>

      </div>
    </section><!-- End Services Section -->



  </main><!-- End #main -->

<?php include "includes/footer.php" ?>
<?php include "includes/js.php" ?>


</body>

</html>



<?php 

  
  if (isset($_POST['update'])) {
   
      $bus_name = $_POST['bus_name'];
      $route = $_POST['route'];
      $btime = $_POST['btime'];
      $week = $_POST['week'];


      $sql = "UPDATE bus_table SET  bus_name = '$bus_name', route = '$route' , btime = '$btime' , week = '$week' WHERE id= '$_GET[eid]'";

      
      if (  mysqli_query($con,$sql)  ){
        ?>
            <script>
              alert('Upload Successfull');
              window.location = 'view-bus.php';
            </script>
        <?php
      }
      else{
        ?>
            <script>
              alert('Error');
              setTimeout(() => {
                    window.location = 'view-bus.php';
                }, 500);
            </script>
        <?php
      }
  }

?>