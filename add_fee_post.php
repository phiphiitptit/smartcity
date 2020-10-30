<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
    if ($_SESSION['user_data']['usertype'] != 1) {
        header("Location:user_dasboard.php");
    }


    $startPos = mysqli_real_escape_string($con, $_REQUEST['startPos']);
    $endPos = mysqli_real_escape_string($con, $_REQUEST['endPos']);
    $costPay = mysqli_real_escape_string($con, $_REQUEST['costPay']);

    if (isset($_POST['save'])) {

        $qr = mysqli_query($con, "INSERT into fee (startPos,endPos,costPay) values ('" . $startPos . "','" . $endPos . "','" . $costPay . "')");

        if ($qr) {
            header("Location:add_fee.php?success=Thêm thành công");
            header("Location:fee_manager.php");
        } else {
            header("Location:add_fee.php?error=Lỗi thêm địa điểm");
        }
    }
    if (isset($_POST['update'])) {
        $id = $_POST['id'];

        $qr = mysqli_query($con, "UPDATE fee SET startPos='" . $startPos . "',endPos='" . $endPos . "',costPay='" . $costPay . "' WHERE id='" . $id . "'");
        // $_SESSION['message'] = "Address updated!"; 
        if ($qr) {
            header("Location:add_fee.php?success=Sửa thành công");
            header("Location:fee_manager.php");
        } else {
            header("Location:add_fee.php?success=Gặp lỗi khi sửa");
        }


        // header("Location:admin_dashboard.php");
    }
    if (isset($_GET['iddelete'])) {
        $id = $_GET['iddelete'];
        $qr = mysqli_query($con, "DELETE FROM fee WHERE id=$id");
        if ($qr) {
            header("Location:fee_manager.php");
        }
    }
} else {
    header("Location:login.php?error=UnAuthorized Access");
}
