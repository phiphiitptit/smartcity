<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
    if ($_SESSION['user_data']['usertype'] != 2) {
        header("Location:user_dashboard.php");
    }
}
$id = $_SESSION['user_data']['id'];

$data = array();
$count = 0;
$qr = mysqli_query($con, "select * from bookcar where iduser=$id and status!=0");
while ($row = mysqli_fetch_assoc($qr)) {
    array_push($data, $row);
}


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

</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="user_dashboard.php"> User</a>
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
            <?php include 'user_menu.php' ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

                <div class="table-responsive">
                    <table class="table table-striped table-sm" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Điểm đi</th>
                                <th>Điểm đến</th>
                                <th>Trạng thái</th>
                                <th>Chi phí</th>
                                <th>Thời gian</th>
                                <th>Thanh toán</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $d) {
                            ?>
                                <tr>
                                    <td><?php echo ++$count; ?></td>
                                    <td><?php echo $d['startPos']; ?></td>
                                    <td><?php echo $d['endPos']; ?></td>
                                    <td>
                                        <?php if ($d['status'] == '0') {
                                            echo "Đang xử lý";
                                        } elseif ($d['status'] == '1') {
                                            echo "Hủy";
                                        } elseif ($d['status'] == '2') {
                                            echo "Đang di chuyển";
                                        } else {
                                            echo "Hoàn thành";
                                        } ?></td>
                                    <td><?php echo $d['costPay']; ?></td>
                                    <td><?php echo $d['created_at']; ?></td>
                                    <td>
                                        <?php if ($d['status']=='1' && $d['doneCost'] == '0') {
                                            echo "Hủy";
                                        } elseif  ($d['status']=='3' && $d['doneCost'] == '0')  {
                                            echo "Chờ thanh toán";
                                        }elseif  ($d['status']=='3' && $d['doneCost'] == '1') {
                                            echo "Đã thanh toán";
                                        } ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
    </script>
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