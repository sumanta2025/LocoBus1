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

  <style>
    .table{
      border-color: black;
    }
    .table tr{
      border-color: black;
    }
    .table tr th{
      border-color: black;
    }
    .table tr td{
      border-color: black;
    }
  </style>

</head>

<body>

<?php include "includes/header.php" ?>

    <!-- ======= Services Section ======= -->
    <section id="services" class="services mt-5">
      <div class="container">

        <div class="section-title">
          <h2>Booking List</h2>
        </div>

         <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
                  <thead>
                      <tr>
                         <th>Sl No.</th>
                          <th>Customer Details</th>
                          <th>Bus Details</th>
                          <th>Journey Details</th>
                          <th>Booking Details</th>
                          <th>Ticket Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>



                  <?php 

                  $sql = "SELECT * FROM booked_table ORDER BY tdate DESC";
                  $result = mysqli_query($con,$sql);
                  $c = 1 ;
                  while (   $rows = mysqli_fetch_assoc($result)    ) {
                   
                        $lsql = "SELECT * FROM location_table WHERE id = '$rows[lid]' ";
                        $lresult = mysqli_query($con, $lsql);
                        $lrow = mysqli_fetch_assoc($lresult);

                        $bsql = "SELECT * FROM bus_table WHERE id = '$rows[bid]' ";
                        $bresult = mysqli_query($con, $bsql);
                        $brow = mysqli_fetch_assoc($bresult);

                        if ($rows['status'] == 'rejected') {
                            $btn = 'Rejected';
                            $btn_color = 'background: #ffcccc'; // red
                        }elseif ($rows['status'] == 'collected'){
                            $btn = "Collected"; 
                            $btn_color = 'background: #b3ffcc';  //green
                        }else{
                            $btn = "Pending";
                            $btn_color = 'background: #f2f2f2'; //grey
                        }
                          
                        
                   ?>
                   <tr style="<?php echo $btn_color ; ?>">

                      <td><?php echo $c ; ?></td>

                      <td>
                       Name: <?php echo $rows['name'] ; ?> <br>
                       Phone:  <?php echo $rows['phone'] ; ?>
                      </td>

                      <td>
                        <?php echo $brow['bus_name'] ; ?> <br> 
                        <?php echo $brow['route'] ; ?><br>
                        <?php echo $brow['week'] ; ?> - <?php echo $brow['btime'] ; ?>
                      </td>

                      <td>
                        <?php echo $lrow['location_name'] ; ?> <br> 
                        Ticket Qnty: <?php echo $rows['qnt'] ; ?>  <br> 
                        Amount:<?php echo $lrow['price']*$rows['qnt'] ; ?> 
                       
                      </td>
                      <td>
                        Book Id: <?php echo $rows['bookingId'] ; ?> <br>
                        Book Date: <?php echo date('d-m-Y', strtotime($rows['tdate'])) ; ?> <br>
                        
                      </td>
                      <td>  
                        <?php echo $btn; ?>
                      </td>
                      <td style="font-size:12px; text-align: center;">  
                        <a href="view-bookedTicket.php?did=<?php echo $rows['id']; ?>" class="btn btn-primary btn-sm" style="background: grey;margin-bottom: 2px;">Accept</a> <br>
                        <a href="view-bookedTicket.php?rejDid=<?php echo $rows['id']; ?>" class="btn btn-primary btn-sm" style="background: grey;">Reject</a>
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

  if (isset($_GET['did'])) {
    
     $sql = "UPDATE booked_table SET status = 'collected' WHERE id = '$_GET[did]'";

     if (mysqli_query($con,$sql)) {
          ?>
           <script>
                  alert('Collected by customer');
                  window.location = 'view-bookedTicket.php';
           </script>
          <?php
      }
      else{
          ?>
          <script>
                  alert('ERROR');
                  setTimeout(() => {
                      window.location = 'view-bookedTicket.php';
                  }, 500);

           </script>

          <?php

      }

  }

  if (isset($_GET['rejDid'])) {
    
     $sql = "UPDATE booked_table SET status = 'rejected' WHERE id = '$_GET[rejDid]'";

     if (mysqli_query($con,$sql)) {
          ?>
           <script>
                  alert('Rejected by customer');
                  window.location = 'view-bookedTicket.php';
           </script>
          <?php
      }
      else{
          ?>
          <script>
                  alert('ERROR');
                  setTimeout(() => {
                      window.location = 'view-bookedTicket.php';
                  }, 500);

           </script>

          <?php

      }

  }
  
?>