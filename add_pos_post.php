<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
	if ($_SESSION['user_data']['usertype'] != 1) {
		header("Location:user_dasboard.php");
	}


	$address = mysqli_real_escape_string($con, $_REQUEST['address']);

	if (isset($_POST['save'])) {
		$sql = mysqli_query($con, "SELECT * FROM pos  WHERE addressPos='".$address."'");
		if (mysqli_num_rows($sql) > 0) {
			header("Location:add_pos.php?error=Lỗi code trùng nhau");
		} else {
			$qr = mysqli_query($con, "INSERT into pos (addressPos) values ('" . $address . "')");

			if ($qr) {
				header("Location:add_pos.php?success=Thêm thành công");
				header("Location:pos_manager.php");
			} else {
				header("Location:add_pos.php?error=Lỗi thêm địa điểm");
			}
		}
	}
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$record = mysqli_query($con, "SELECT * FROM pos WHERE id=$id");
		$data = mysqli_fetch_array($record);
		$sql = mysqli_query($con, "SELECT * FROM pos  WHERE addressPos='".$address."' and id <> '".$id."'");
		if (mysqli_num_rows($sql) > 0) {
			header("Location:add_pos.php?error=Lỗi thêm Địa điểm trùng nhau");
		} else {
			$qr = mysqli_query($con, "UPDATE pos SET addressPos='" . $address . "' WHERE id='" . $id . "'");
			// $_SESSION['message'] = "Address updated!"; 
			if ($qr) {
				header("Location:add_pos.php?success=Sửa thành công");
				header("Location:pos_manager.php");
			} else {
				header("Location:add_pos.php?success=Gặp lỗi khi sửa");
			}
		}

		// header("Location:teacher_dasboard.php");
	}
	if (isset($_GET['iddelete'])) {
		$id = $_GET['iddelete'];
		$qr = mysqli_query($con, "DELETE FROM pos WHERE id=$id");
		if ($qr) {
			header("Location:pos_manager.php");
		}
	}
} else {
	header("Location:login.php?error=UnAuthorized Access");
}
