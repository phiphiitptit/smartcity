<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
	if ($_SESSION['user_data']['usertype'] != 1) {
		header("Location:user_dasboard.php");
	}


	$code = mysqli_real_escape_string($con, $_REQUEST['code']);
	$socho = mysqli_real_escape_string($con, $_REQUEST['socho']);

	if (isset($_POST['save'])) {
		$sql = mysqli_query($con, "SELECT * FROM car  WHERE code='".$code."'");
		if (mysqli_num_rows($sql) > 0) {
			header("Location:add_car.php?error=Lỗi code trùng nhau");
		} else {
			$qr = mysqli_query($con, "INSERT into car (code,socho) values ('" . $code . "','" . $socho . "')");

			if ($qr) {
				header("Location:add_car.php?success=Thêm thành công");
				header("Location:car_manager.php");
			} else {
				header("Location:add_car.php?error=Lỗi thêm  xe");
			}
		}
	}
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		
		$record = mysqli_query($con, "SELECT * FROM car WHERE id=$id");
		$data = mysqli_fetch_array($record);
		$sql = mysqli_query($con, "SELECT * FROM car  WHERE code='".$code."' and id <> '".$id."'");
		if (mysqli_num_rows($sql) > 0) {
			header("Location:add_car.php?error=Lỗi thêm code trùng nhau");
		} else {
			$qr = mysqli_query($con, "UPDATE car SET code='" . $code . "', socho='" . $socho . "' WHERE id='" . $id . "'");
			// $_SESSION['message'] = "Address updated!"; 
			if ($qr) {
				header("Location:add_car.php?success=Sửa thành công");
				header("Location:car_manager.php");
			} else {
				header("Location:add_car.php?success=Gặp lỗi khi sửa");
			}
		}

		// header("Location:admin_dashboard.php");
	}
	if (isset($_GET['iddelete'])) {
		$id = $_GET['iddelete'];
		$qr = mysqli_query($con, "DELETE FROM car WHERE id=$id");
		if ($qr) {
			header("Location:car_manager.php");
		}
	}
} else {
	header("Location:login.php?error=UnAuthorized Access");
}
