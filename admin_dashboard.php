<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
    if ($_SESSION['user_data']['usertype'] != 1) {
        header("Location:user_dasboard.php");
    }
}

$data = array();
$count = 0;
$qr = mysqli_query($con, "select * from user");
while ($row = mysqli_fetch_assoc($qr)) {
    array_push($data, $row);
}
$dataCar = array();
$count = 0;
$qr = mysqli_query($con, "select * from car");
while ($row = mysqli_fetch_assoc($qr)) {
    array_push($dataCar, $row);
}
$dataBook = array();
$count = 0;
$qr = mysqli_query($con, "select * from bookcar");
while ($row = mysqli_fetch_assoc($qr)) {
    array_push($dataBook, $row);
}
$dataBookDone = array();
$count = 0;
$qr = mysqli_query($con, "select * from bookcar where status=3");
while ($row = mysqli_fetch_assoc($qr)) {
    array_push($dataBookDone, $row);
}
$dataBookCancel = array();
$count = 0;
$qr = mysqli_query($con, "select * from bookcar where status=1");
while ($row = mysqli_fetch_assoc($qr)) {
    array_push($dataBookCancel, $row);
}
$done = sizeof($dataBookDone);
$cancel = sizeof($dataBookCancel);
// $dataBookCancel = array();
// $count = 0;
// $qr = mysqli_query($con, "select * from bookcar where status=1");
// while ($row = mysqli_fetch_assoc($qr)) {
//     array_push($dataBookCancel, $row);
// }
$dataPoints = array(
    array("label" => "Hoàn thành", "y" => $done / ($done + $cancel) * 100),
    array("label" => "Hủy", "y" => $cancel / ($done + $cancel) * 100),
)



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js">
    </script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <meta name="theme-color" content="#563d7c">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <script>
        window.onload = function() {


            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Thống kê đặt xe"
                },
                subtitles: [{
                    text: "November 2020"
                }],
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="teacher_dasboard.php">Admin</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php">Đăng xuất</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <?php include 'admin_menu.php' ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="row">
                    <div class=" card form-group col-md-4" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Tổng số người dùng</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo sizeof($data); ?> người</h6>
                        </div>

                    </div>
                    <div class=" card form-group col-md-4" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Tổng số xe</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo sizeof($dataCar); ?> Xe</h6>
                        </div>

                    </div>
                    <div class=" card form-group col-md-4" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">Tổng số chuyến</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><?php echo sizeof($dataBook); ?> Chuyến</h6>
                        </div>

                    </div>
                </div>
                <div class="row">

                    <div class="card form-group col-sm-8 " style="width: 18rem;">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card form-group" style="width: 18rem; background-color:aquamarine">
                            <div class="card-body">
                                <h5 class="card-title">Tổng số chuyến xe</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo sizeof($dataBook); ?> Chuyến</h6>
                            </div>

                        </div>
                        <div class="card form-group" style="width: 18rem; background-color:aquamarine">
                            <div class="card-body">
                                <h5 class="card-title">Tổng số chuyến thành công</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo sizeof($dataBookDone); ?> Chuyến</h6>
                            </div>

                        </div>
                        <div class="card form-group" style="width: 18rem; background-color:orange">
                            <div class="card-body">
                                <h5 class="card-title">Tổng số chuyến hủy</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo sizeof($dataBookCancel); ?> Chuyến</h6>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="row">


                    <div class="col-sm-4">
                        <div class="card form-group" style="width: 18rem; background-color:aquamarine">
                            <div class="card-body">
                                <h5 class="card-title">Tổng doanh thu </h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo sizeof($dataBook); ?> Chuyến</h6>
                            </div>

                        </div>
                        <div class="card form-group" style="width: 18rem; background-color:aquamarine">
                            <div class="card-body">
                                <h5 class="card-title">Đã thanh toán</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo sizeof($dataBookDone); ?> Chuyến</h6>
                            </div>

                        </div>
                        <div class="card form-group" style="width: 18rem; background-color:orange">
                            <div class="card-body">
                                <h5 class="card-title">Chưa thanh toán</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo sizeof($dataBookCancel); ?> Chuyến</h6>
                            </div>

                        </div>

                    </div>
                    <div class="card form-group col-sm-8" style="width: 18rem;">
                        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>

                </div>

            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">

    </script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="https://getbootstrap.com/docs/4.5/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="dashboard.js"></script>
</body>

</html>