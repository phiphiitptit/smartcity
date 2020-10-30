<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
    if ($_SESSION['user_data']['usertype'] != 1) {
        header("Location:user_dasboard.php");
    }


   
    // $socho = mysqli_real_escape_string($con, $_REQUEST['socho']);

    if (isset($_POST['saveCode'])) {
        $code = mysqli_real_escape_string($con, $_REQUEST['code']);
        $id = $_POST['id'];
        $record = mysqli_query($con, "SELECT * FROM bookcar WHERE id=$id");

        $qr = mysqli_query($con, "UPDATE bookcar SET codeCar='" . $code . "', status='2' WHERE id='" . $id . "'");
        // $_SESSION['message'] = "Address updated!"; 
        if ($qr) {
            header("Location:add_bookcar.php?success=Sửa thành công");
            header("Location:book_manager.php");
        } else {
            header("Location:add_bookcar.php?success=Gặp lỗi khi sửa");
        }


        // header("Location:admin_dashboard.php");
    }
    if (isset($_GET['iddone'])) {
        $id = $_GET['iddone'];
        $record = mysqli_query($con, "SELECT * FROM bookcar WHERE id=$id");

        $qr = mysqli_query($con, "UPDATE bookcar SET status='3' WHERE id='" . $id . "'");
        // $_SESSION['message'] = "Address updated!"; 
        if ($qr) {
            header("Location:add_bookcar.php?success=Sửa thành công");
            header("Location:book_manager.php");
        } else {
            header("Location:add_bookcar.php?success=Gặp lỗi khi sửa");
        }


        // header("Location:admin_dashboard.php");
    }
    if (isset($_POST['saveCode'])) {
        $id = $_POST['id'];
        $record = mysqli_query($con, "SELECT * FROM bookcar WHERE id=$id");

        $qr = mysqli_query($con, "UPDATE bookcar SET codeCar='" . $code . "', status='2' WHERE id='" . $id . "'");
        // $_SESSION['message'] = "Address updated!"; 
        if ($qr) {
            header("Location:add_bookcar.php?success=Sửa thành công");
            header("Location:book_manager.php");
        } else {
            header("Location:add_bookcar.php?success=Gặp lỗi khi sửa");
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
