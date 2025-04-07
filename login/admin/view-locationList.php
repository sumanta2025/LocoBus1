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
        
        <div class="section-title">
          <h2>Location & Price</h2>
        </div>
                <div style="text-align: right;margin-bottom: 10px;"> <a href="add-locationList.php" class="btn btn-primary">Add Location & Price</a></div>
               <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                         <th>sl</th>
                          <th>location</th>
                          <th>Price</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>



                  <?php 

                  $sql = "SELECT * FROM location_table ORDER BY id DESC";
                  $result = mysqli_query($con,$sql);
                  $c = 1 ;
                  while (   $rows = mysqli_fetch_assoc($result)    ) {
                   
                   ?>


                   <tr>
                      <td><?php echo $c ; ?></td>
                      <td><?php echo $rows['location_name'] ; ?></td>
                      <td><?php echo $rows['price'] ; ?>/-</td>
                      <td>
                        <a href="edit-locationList.php?eid=<?php echo $rows['id']; ?>" class="btn btn-warning">Edit</a>  
                        <a href="view-locationList.php?delid=<?php echo $rows['id']; ?>" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>


                  <?php
                  $c++;
                  }
                  ?>
                     



                  </tbody>
              </table>
          <!-- table end -->


        <br><br>
      </div>
    </section><!-- End Counts Section -->


  </main><!-- End #main -->

 <!-- ======= Footer ======= -->

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
  
  $sql =  "DELETE FROM location_table WHERE id = '$_GET[delid]' ";

  if (  mysqli_query($con,$sql)  ){
        ?>
            <script>
              alert('Successfully Deleted');
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