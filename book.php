<?php 
  include "db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "includes/css.php" ?>
  <style>

      .plane {
        margin: 1px auto;
        max-width: 300px;
      }

      .exit {
        position: relative;
        height: 50px;
      }
      .exit:before, .exit:after {
        content: "EXIT";
        font-size: 14px;
        line-height: 18px;
        padding: 0px 2px;
        font-family: "Arial Narrow", Arial, sans-serif;
        display: block;
        position: absolute;
        background: green;
        color: white;
        top: 50%;
        transform: translate(0, -50%);
      }
      .exit:before {
        left: 0;
      }
      .exit:after {
        right: 0;
      }

      .fuselage {
        border-right: 5px solid #d8d8d8;
        border-left: 5px solid #d8d8d8;
      }

      ol {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .seats {
        display: flex;
        flex-direction: rowz;
        flex-wrap: nowrap;
        justify-content: flex-start;
      }

      .seat {
        display: flex;
        flex: 0 0 14.28571428571429%;
        padding: 5px;
        position: relative;
      }
      .seat:nth-child(3) {
        margin-right: 14.28571428571429%;
      }
      .seat input[type=checkbox] {
        position: absolute;
        opacity: 0;
      }
      .seat input[type=checkbox]:checked + label {
        background: #ffd11a; 
        -webkit-animation-name: rubberBand;
        animation-name: rubberBand;
        animation-duration: 300ms;
        animation-fill-mode: both;
      }
      .seat input[type=checkbox]:disabled + label {
        background: #dddddd;
        /* text-indent: -9999px; */
        overflow: hidden;
      }
      .seat input[type=checkbox]:disabled + label:after {
        /* content: "X";  */
        text-indent: 0;
        position: absolute;
        top: 4px;
        left: 50%;
        transform: translate(-50%, 0%);
      } 
      .seat input[type=checkbox]:disabled + label:hover {
        box-shadow: none;
        cursor: not-allowed;
      }
      .seat label {
        display: block;
        position: relative;
        width: 100%;
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        line-height: 1.5rem;
        padding: 4px 0;
        background: #bada55; 
        border-radius: 5px;
        animation-duration: 300ms;
        animation-fill-mode: both;
      }
      .seat label:before {
        /* content: ""; */
        position: absolute;
        width: 75%;
        height: 75%;
        top: 1px;
        left: 50%;
        transform: translate(-50%, 0%);
        background: rgba(255, 255, 255, 0.4);
        border-radius: 3px;
      }
      .seat label:hover {
        cursor: pointer;
        box-shadow: 0 0 0px 2px #5C6AFF;
      }

      @-webkit-keyframes rubberBand {
        0% {
          -webkit-transform: scale3d(1, 1, 1);
          transform: scale3d(1, 1, 1);
        }
        30% {
          -webkit-transform: scale3d(1.25, 0.75, 1);
          transform: scale3d(1.25, 0.75, 1);
        }
        40% {
          -webkit-transform: scale3d(0.75, 1.25, 1);
          transform: scale3d(0.75, 1.25, 1);
        }
        50% {
          -webkit-transform: scale3d(1.15, 0.85, 1);
          transform: scale3d(1.15, 0.85, 1);
        }
        65% {
          -webkit-transform: scale3d(0.95, 1.05, 1);
          transform: scale3d(0.95, 1.05, 1);
        }
        75% {
          -webkit-transform: scale3d(1.05, 0.95, 1);
          transform: scale3d(1.05, 0.95, 1);
        }
        100% {
          -webkit-transform: scale3d(1, 1, 1);
          transform: scale3d(1, 1, 1);
        }
      }
      @keyframes rubberBand {
        0% {
          -webkit-transform: scale3d(1, 1, 1);
          transform: scale3d(1, 1, 1);
        }
        30% {
          -webkit-transform: scale3d(1.25, 0.75, 1);
          transform: scale3d(1.25, 0.75, 1);
        }
        40% {
          -webkit-transform: scale3d(0.75, 1.25, 1);
          transform: scale3d(0.75, 1.25, 1);
        }
        50% {
          -webkit-transform: scale3d(1.15, 0.85, 1);
          transform: scale3d(1.15, 0.85, 1);
        }
        65% {
          -webkit-transform: scale3d(0.95, 1.05, 1);
          transform: scale3d(0.95, 1.05, 1);
        }
        75% {
          -webkit-transform: scale3d(1.05, 0.95, 1);
          transform: scale3d(1.05, 0.95, 1);
        }
        100% {
          -webkit-transform: scale3d(1, 1, 1);
          transform: scale3d(1, 1, 1);
        }
      }
      .rubberBand {
        -webkit-animation-name: rubberBand;
        animation-name: rubberBand;
      }

      /*  #F42536 red    //  #ffd11a  yellow  //  #bada55 green */ 
  </style>
</head>

<body>
<?php include "includes/header.php" ?>

  <main id="main">

        <section id="appointment" class="appointment section-bg" style="margin-top:50px;">
            <div class="container">

              <div class="section-title mt-5">
                <h2>Book Your Bus</h2>
              </div>
              <form action="" method="post" role="form">
                <div class="row">
                  <div class="col-md-6">

                    <div class="plane">
                        <!-- <h5 style="text-align:center;font-weight: bold;">Select Bus & Seats</h5> -->
                        <div class="form-group">
                          <label style="font-weight: bold;">Bus Name</label>
                          <select name="busId" id="busId" class="form-control" required>
                            <option value="">Select Bus</option>
                            <?php 
                              $sql = "SELECT * FROM bus_table ";
                              $result = mysqli_query($con, $sql);
                              while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                                 <option value="<?php echo $rows['id'];?>">
                                  <?php echo $rows['bus_name']; ?> ( <?php echo $rows['route']; ?> ) <?php echo $rows['week']; ?> - <?php echo $rows['btime']; ?> 
                                </option>
                            <?php
                              }
                            ?>
                          </select>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: bold;">Travel Date</label>
                           <input type="date" name="tdate" class="form-control" id="tdate" placeholder="Travel Date" required>
                        </div>
                      <div class="fuselage">
                        
                      </div>
                      <label style="font-weight: bold;">Select Seats</label>
                      <ol class="cabin fuselage">
                        <li class="rowz row--1">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" disabled id="1A" />
                              <label for="1A">1A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="1B" />
                              <label for="1B">1B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="1C" />
                              <label for="1C">1C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="1D" />
                              <label for="1D">1D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="1E" />
                              <label for="1E">1E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="1F" />
                              <label for="1F">1F</label>
                            </li>
                          </ol>
                        </li>
                        <li class="rowz row--2">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" id="2A" name="seat[]" value="2A"/>
                              <label for="2A">2A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="2B" name="seat[]" value="2B" />
                              <label for="2B">2B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="2C" name="seat[]" value="2C"/>
                              <label for="2C">2C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="2D" name="seat[]" value="2D" />
                              <label for="2D">2D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="2E" name="seat[]" value="2E" />
                              <label for="2E">2E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="2F" name="seat[]" value="2F"/>
                              <label for="2F">2F</label>
                            </li>
                          </ol>
                        </li>
                        <li class="rowz row--3">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" id="3A" name="seat[]" value="3A" />
                              <label for="3A">3A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="3B" name="seat[]" value="3B" />
                              <label for="3B">3B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="3C" name="seat[]" value="3C" />
                              <label for="3C">3C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="3D" name="seat[]" value="3D" />
                              <label for="3D">3D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="3E" name="seat[]" value="3E" />
                              <label for="3E">3E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="3F" name="seat[]" value="3F" />
                              <label for="3F">3F</label>
                            </li>
                          </ol>
                        </li>
                        <li class="rowz row--4">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" disabled  id="4A" />
                              <label for="4A">4A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled  id="4B" />
                              <label for="4B">4B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled  id="4C" />
                              <label for="4C">4C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox"  disabled id="4D" />
                              <label for="4D">4D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="4E" />
                              <label for="4E">4E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="4F" />
                              <label for="4F">4F</label>
                            </li>
                          </ol>
                        </li>
                        <li class="rowz row--5">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" disabled id="5A" />
                              <label for="5A">5A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="5B" />
                              <label for="5B">5B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="5C" />
                              <label for="5C">5C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="5D" />
                              <label for="5D">5D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="5E" />
                              <label for="5E">5E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="5F" />
                              <label for="5F">5F</label>
                            </li>
                          </ol>
                        </li>
                        <li class="rowz row--6">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" id="6A" name="seat[]" value="6A"  />
                              <label for="6A">6A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="6B"  name="seat[]" value="6B" />
                              <label for="6B">6B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="6C"  name="seat[]" value="6C" />
                              <label for="6C">6C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="6D" name="seat[]" value="6D"  />
                              <label for="6D">6D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="6E"  name="seat[]" value="6E" />
                              <label for="6E">6E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="6F"  name="seat[]" value="6F" />
                              <label for="6F">6F</label>
                            </li>
                          </ol>
                        </li>
                        <li class="rowz row--7">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" disabled id="7A" />
                              <label for="7A">7A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="7B" />
                              <label for="7B">7B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="7C" />
                              <label for="7C">7C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="7D" />
                              <label for="7D">7D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="7E" />
                              <label for="7E">7E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="7F" />
                              <label for="7F">7F</label>
                            </li>
                          </ol>
                        </li>
                        <li class="rowz row--8">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" disabled id="8A" />
                              <label for="8A">8A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="8B" />
                              <label for="8B">8B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="8C" />
                              <label for="8C">8C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="8D" />
                              <label for="8D">8D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="8E" />
                              <label for="8E">8E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="8F" />
                              <label for="8F">8F</label>
                            </li>
                          </ol>
                        </li>
                        <li class="rowz row--9">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" id="9A" name="seat[]" value="9A" />
                              <label for="9A">9A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="9B" name="seat[]" value="9B" />
                              <label for="9B">9B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="9C"  name="seat[]" value="9C" />
                              <label for="9C">9C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="9D" name="seat[]" value="9D" />
                              <label for="9D">9D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="9E" name="seat[]" value="9E" />
                              <label for="9E">9E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" id="9F" name="seat[]" value="9F" />
                              <label for="9F">9F</label>
                            </li>
                          </ol>
                        </li>
                        <li class="rowz row--10">
                          <ol class="seats" type="A">
                            <li class="seat">
                              <input type="checkbox" disabled id="10A" />
                              <label for="10A">10A</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="10B" />
                              <label for="10B">10B</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="10C" />
                              <label for="10C">10C</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="10D" />
                              <label for="10D">10D</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="10E" />
                              <label for="10E">10E</label>
                            </li>
                            <li class="seat">
                              <input type="checkbox" disabled id="10F" />
                              <label for="10F">10F</label>
                            </li>
                          </ol>
                        </li>
                      </ol>
                      <div class="fuselage">
                        
                      </div>
                    </div>

                  </div>
                  <div class="col-md-6">

                    <div style="margin: 10px auto;">
                      <div class="form-row">
                        <div class="col-md-6 form-group">
                          <label style="font-weight: bold;">Name</label>
                          <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label style="font-weight: bold;">Phone No.</label>
                          <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required>
                        </div>
                        <div class="col-md-6 form-group">
                          <label style="font-weight: bold;">Email Id</label>
                          <input type="tel" class="form-control" name="email" id="email" placeholder="Your Email" required>
                        </div>
                        <div class="col-md-6 form-group">
                          
                          <label style="font-weight: bold;">Travel Location</label>

                          <select name="lid" id="lid" class="form-control" required>
                            <option value="">Arrival-Departure Location</option>
                            <?php 
                              $sql = "SELECT * FROM location_table ";
                              $result = mysqli_query($con, $sql);
                              while ($rows = mysqli_fetch_assoc($result)) {
                            ?>
                                 <option value="<?php echo $rows['id'];?>">
                                  <?php echo $rows['location_name']; ?>
                                </option>
                            <?php
                              }
                            ?>
                          </select>

                          <input type="hidden" name="bookingId" id="bookingId" value="<?php echo 'LOCO'.rand(1000000,1000000000); ?>">
 
                        </div>
                      </div>
                      <div class="form-row">
                       
                        <div class="col-md-12 form-group">

                                               
                      </div>
                      <div class="text-center"><button class="btn btn-primary" type="submit" name="submit">Book Now</button></div>
                    </div>

                  </div>
                </div>
              </form>
            </div>
        </section>

        <div class="modal fade" id="myModal" role="dialog" >
          <div class="modal-dialog" >
          
            <!-- Modal content-->
            <div class="modal-content" style="background:#ccccff ;">
              <div class="modal-header">
                <h5 class="modal-title" style="text-align:left;">Booking Successfull</h5>
                <button type="button" class="close" da ta-dismiss="modal" id="closeModelBtn">&times;</button>
                
              </div>
              <div class="modal-body">
                <p>
                    Your Booking Id is <span id="bookingIdShow"></span> <br>
                    Please copy your booking id or take a screenshot of this page.<br>Contact with Bus conductor and show your booking id to collect your physical ticket.
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" da ta-dismiss="modal" id="closeModelBtn">Close</button>
              </div>
            </div>
            
          </div>
        </div>

  </main><!-- End #main -->

  
<?php include "includes/footer.php" ?>
<?php include "includes/js.php"  ;
?>
            
<script type="text/javascript">
            
  $(document).ready(function(){

    function activeSeats(){
        var defaultActiveSeats = ['2A','2B','2C','2D','2E','2F','3A','3B','3C','3D','3E','3F','6A','6B','6C','6D','6E','6F','9A','9B','9C','9D','9E','9F'];
          $.each(defaultActiveSeats, function(index, seatNo) {
              $('#'+seatNo).attr('disabled', false);

          });
    }
    

    $("#closeModelBtn").on("click",function(){
      window.location = 'book.php';
    });
      
    $("#busId").change(function(){
      
      activeSeats();
      var busId = $("#busId").val() ;
      var travelDate = $("#tdate").val() ;
      bookedBusSeatList(busId,travelDate)

    });
    $("#tdate").change(function(){

      activeSeats();
      var busId = $("#busId").val() ;
      var travelDate = $("#tdate").val() ;
      bookedBusSeatList(busId,travelDate)

    });

    function bookedBusSeatList(busId,travelDate){

        if (busId != '' && travelDate != '') {

          $.ajax({
                url: "bookedInfoByBusId.php",
                method: "POST",
                data: {
                    busId: busId,
                    travelDate: travelDate,
                    action : "bookedBusSeatList"
                },
                dataType: 'json',
                // error: function (xhr) {
                //     var readyState = {
                //         1: "Loading",
                //         2: "Loaded",
                //         3: "Interactive",
                //         4: "Complete"
                //     };
                //     if(xhr.readyState !== 0 && xhr.status !== 0 && xhr.responseText !== undefined) {
                //         console.log("readyState: " + readyState[xhr.readyState] + "\n status: " + xhr.status + "\n\n responseText: " + xhr.responseText);
                //     }
                // },
                success: function (data) {
                    
                    jQuery.each(data.seatArr, function(index, seatNo) {
                        $('#'+seatNo).attr('disabled', 'disabled');
                        $("#"+seatNo).closest("li").find("label").css("background", "#F42536");

                    });

                }
          });
        }
    }
      
  });
  


</script>

</body>

</html>


<?php 

  if ( isset($_POST['submit']) ) {

      

      if (empty($_POST['seat'])) {

        ?> <script> alert('Select Your Seat'); </script> <?php

      }else{
    
          $name = $_POST['name'];
          $phone = $_POST['phone'];
          $email = $_POST['email'];
          $busId = $_POST['busId'];
          $locationId = $_POST['lid'];
          $bookingDate = $_POST['tdate'];
          $qnt = count($_POST['seat']);
          $seatStr = implode(',',$_POST['seat']) ;

          // $bookingId =  substr($_POST['name'], 0, 3).$busId.$locationId.rand(1000000,1000000000);
          $bookingId =  $_POST['bookingId'];


          $sql = "INSERT INTO booked_table( bookingId, name, phone, email, bid, lid, tdate, qnt, seats ) VALUES('$bookingId', '$name', '$phone', '$email', '$busId', '$locationId', '$bookingDate', '$qnt', '$seatStr' )";

          if ( mysqli_query($con,$sql) ){
            ?>
              <script>
                
                var bookingId = $("#bookingId").val() ;
                $("#bookingIdShow").text(bookingId) ;
                $('#myModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });

              </script>
            <?php
          }
          else{
            ?>
                <script>
                  alert('Error');
                  setTimeout(() => {
                        window.location = 'book.php';
                    }, 500);
                </script>
            <?php
          }
      }


  }

?>

