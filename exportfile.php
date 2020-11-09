<?php
/*
* iTech Empires:  Export Data from MySQL to CSV Script
* Version: 1.0.0
* Page: Export
*/
// Database Connection
require("config.php");
$montht = mysqli_real_escape_string($con, $_REQUEST['month']);
$yeart = mysqli_real_escape_string($con, $_REQUEST['year']);

$qr = mysqli_query($con, "SELECT user.name, SUM(bookcar.costPay) sumPay,Month(bookcar.created_at) mon,YEAR(bookcar.created_at) yearr
     FROM  bookcar
     Join user ON user.id = bookcar.iduser
     where bookcar.status = 3 and Month(bookcar.created_at)='".$montht."' and YEAR(bookcar.created_at)='".$yeart."'
     GROUP BY bookcar.iduser,mon,yearr
    order by mon");
// get Users
$data = array();
$count = 0;
while ($row = mysqli_fetch_assoc($qr)) {
    array_push($data, $row);
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Quyettoan.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array(' Name', 'Money', 'Month', 'Year'));

if (count($data) > 0) {
    foreach ($data as $row) {
        fputcsv($output, $row);
    }
}
