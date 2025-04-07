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
          <h2>Bus Details</h2>
        </div>

           <div style="text-align: right;margin-bottom: 10px;"> <a href="add-bus.php" class="btn btn-primary">Add Bus Details</a></div>

         <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                         <th>sl</th>
                          <th>Bus Name</th>
                          <th>Route</th>
                          <th>Time</th>
                          <th>Week</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>



                  <?php 

                  $sql = "SELECT * FROM bus_table ORDER BY bus_name ASC";
                  $result = mysqli_query($con,$sql);
                  $c = 1 ;
                  while (   $rows = mysqli_fetch_assoc($result)    ) {
                   
                   ?>


                   <tr>
                      <td><?php echo $c ; ?></td>
                      <td><?php echo $rows['bus_name'] ; ?></td>
                      <td><?php echo $rows['route'] ; ?></td>
                      <td><?php echo $rows['btime'] ; ?></td>
                      <td><?php echo $rows['week'] ; ?></td>
                      <td> 
                        <a href="edit-bus.php?eid=<?php echo $rows['id']; ?>" class="btn btn-warning">Edit</a>  
                        <a href="view-bus.php?delid=<?php echo $rows['id']; ?>" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>


                  <?php
                  $c++;
                  }
                  ?>
                     



                  </tbody>
              </table>
          <!-- table end -->

      </div>
    </section><!-- End Services Section -->



  </main><!-- End #main -->

<?php include "includes/footer.php" ?>
<?php include "includes/js.php" ?>



<script type="text/javascript">

  $(document).ready(function() {
      $('#datatable').DataTable();
  });

</script>

</body>

</html>



<?php 

if (isset($_GET['delid'])) {
  
  $sql =  "DELETE FROM bus_table WHERE id = '$_GET[delid]' ";

  if (  mysqli_query($con,$sql)  ){
        ?>
            <script>
              alert('Successfully Deleted');
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