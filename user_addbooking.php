<?php
session_start();
include 'config.php';

function function_alert($message) {
	echo "<script>alert('$message');</script>";
}

$id = $_SESSION['user_data']['id'];


$start = mysqli_real_escape_string($con, $_REQUEST['start']);
$stop = mysqli_real_escape_string($con, $_REQUEST['stop']);

//Kiểm tra pending_booking

$pending=mysqli_query($con, "select * from bookcar where status=0 and iduser='".$id."'");
$pen=mysqli_fetch_assoc($pending);



//Lấy costPay
$result = mysqli_query($con, "select * from fee where (startPos='".$start."' and endPos='".$stop."')or(startPos='".$stop."' and endPos='".$start."')");
$f = mysqli_fetch_assoc($result);
$fee=$f['costPay'];

if ($start=="0"){
	$_SESSION['booking_state']='missing_start';
	header("Location:user_booking.php");
}
elseif ($stop=="0"){
	$_SESSION['booking_state']='missing_stop';
	header("Location:user_booking.php");
}
elseif ($start == $stop) {
	$_SESSION['booking_state']='indifferent';
	header("Location:user_booking.php");
}
elseif ($pen){
	$_SESSION['booking_state']='pending';
	header("Location:user_booking.php");
}
else{
	$qr = mysqli_query($con, "INSERT into bookcar (startPos,endPos,costPay,created_at,status,iduser) values (
	'" . $start . "','" . $stop . "','" . $fee . "','" . date('Y-m-d H:i:s') . "','0','" . $id . "')");

	if ($qr) {
			$_SESSION['booking_state']='success';
			header("Location:user_booking.php?succss=Thêm thành công");
			echo '<script>alert("Welcome to Geeks for Geeks")</script>';


		} else {
			$_SESSION['booking_state']='error';
			header("Location:user_booking.php?error=Lỗi ");
		}

	}
?>