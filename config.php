<?php
$host = "localhost";
$username = "phiphi";
$password = "3lKUkKrBpEUhNNzk";
$database = "smartcitydb";

$con = mysqli_connect($host,$username,$password,$database);
if(!$con){
	die("Lỗi kết nối database");
}

?>