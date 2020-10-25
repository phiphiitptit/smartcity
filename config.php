<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "smartcitydb";

$con = mysqli_connect($host,$username,$password,$database);
if(!$con){
	die("Lỗi kết nối database");
}

?>