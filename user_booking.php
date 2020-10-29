<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {
    if ($_SESSION['user_data']['usertype'] != 2) {
        header("Location:user_dashboard.php");
    }
}
function function_alert($message)
{

    // Display the alert box
    echo "<script>alert('$message');</script>";
}
$dataPos = array();
$count = 0;
$qr = mysqli_query($con, "select * from pos");
while ($row = mysqli_fetch_assoc($qr)) {
    array_push($dataPos, $row);
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

    <script src="modal.js"></script>



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
    <?php if ($_SESSION['booking_state'] == 'missing_start') {
        function_alert("Bạn chưa chọn điểm xuất phát");
    } elseif ($_SESSION['booking_state'] == 'missing_stop') {
        function_alert("Bạn chưa chọn điểm đến");
    } elseif ($_SESSION['booking_state'] == 'indifferent') {
        function_alert("Điểm xuất phát và điểm đến không được trùng nhau");
    } elseif ($_SESSION['booking_state'] == 'success') {
        function_alert("Đặt xe thành công");
    } elseif ($_SESSION['booking_state'] == 'error') {
        function_alert("Đặt xe thất bại");
    } elseif ($_SESSION['booking_state'] == 'pending') {
        function_alert("Bạn chưa thể đặt chuyến xe mới.");
    } ?>

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
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Some text in the Modal..</p>
        </div>

    </div>

    <div class="container-fluid">
        <div class="row">
            <?php include 'user_menu.php' ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

                <form action="user_addbooking.php" method="post">
                    <div class="booking">
                        <br><br>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputName">Điểm Bắt Đầu</label>
                                <select name="start" class="form-control">
                                    <option value="0">--Chọn điểm đi--</option>
                                    <?php
                                    foreach ($dataPos as $d) {
                                    ?>

                                        <option value="<?php echo $d['addressPos']; ?>"><?php echo $d['addressPos']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputName">Điểm Kết Thúc</label>
                                <select name="stop" class="form-control">
                                    <option value="0">--Chọn điểm đến--</option>
                                    <?php
                                    foreach ($dataPos as $d) {
                                    ?>

                                        <option value="<?php echo $d['addressPos']; ?>"><?php echo $d['addressPos']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- <select name="start">
                      <option value="0">--Chọn điểm đi--</option>
                      <option value='Battery Area'>Battery Area</option>
                      <option value='Cinema'>Cinema</option>
                      <option value='Home'>Home</option>
                      <option value='School'>School</option>
                      <option value='Shopping Center'>Shopping Center</option>
                      <option value='Zoo'>Zoo</option>
                    </select>

                    <select name="stop">
                       <option value="0">--Chọn điểm đến--</option>
											 <option value='Battery Area'>Battery Area</option>
                       <option value='Cinema'>Cinema</option>
                       <option value='Home'>Home</option>
                       <option value='School'>School</option>
                       <option value='Shopping Center'>Shopping Center</option>
                       <option value='Zoo'>Zoo</option>
                    </select> -->

                        <script>
                            function myFunction() {
                                alert("Hello! I am an alert box!");
                            }
                        </script>
                        <button class="btn btn-sm btn-dark" type="submit" onclick="booking_alert">Đặt xe</button>





                    </div>

                </form>
                <br><br>


                <center><img src="anhmap.png" width="100%" height="auto" ;> </center>



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