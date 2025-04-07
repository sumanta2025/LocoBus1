<?php 

require_once('db.php');

$result = array();

if ( isset($_POST['action']) && $_POST['action']== 'bookedBusSeatList') {

	if (!empty($_POST['busId'])  && !empty($_POST['travelDate']) ) {

		$sql = "SELECT `seats`,`status`
				FROM booked_table 
				WHERE bid = '$_POST[busId]' 
					AND tdate = '$_POST[travelDate]' 
					AND status != 'rejected' ";
		$run = mysqli_query($con,$sql);

		$seatArr = array();
		$seatStr = '';
		$key = 0 ;
		while ($rows = mysqli_fetch_assoc($run)) {
			$result[$key] = $rows ;
			$seatStr .= $rows['seats'].',';
			$key++;
		}

		if ($seatStr != '') {
			$seatStr = substr($seatStr, 0, -1);
			$seatArr = explode(",", $seatStr) ;
		}
		$result['seatStr'] = $seatStr ;
		$result['seatArr'] = $seatArr ;

		
			
		
	}

	echo json_encode($result);
}

?>

