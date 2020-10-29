<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {


    $id = $_SESSION['user_data']['id'];

    $qr = mysqli_query($con, "SELECT user.name,bookcar.codeCar,bookcar.startPos,bookcar.endPos,bookcar.costPay,bookcar.status,bookcar.created_at,bookcar.id
         FROM  bookcar
         Join user ON user.id = bookcar.iduser
         where bookcar.status = 0 
        order by bookcar.id");
    $data_booking = array();
    $count = 0;
    while ($row = mysqli_fetch_assoc($qr)) {
        array_push($data_booking, $row);
    }
    $qr = mysqli_query($con, "SELECT user.name,bookcar.codeCar,bookcar.startPos,bookcar.endPos,bookcar.costPay,bookcar.status,bookcar.created_at,bookcar.id
    FROM  bookcar
    Join user ON user.id = bookcar.iduser
    where bookcar.status=1
   order by bookcar.id");
    $data_cancel = array();
    while ($row = mysqli_fetch_assoc($qr)) {
        array_push($data_cancel, $row);
    }
    $qr = mysqli_query($con, "SELECT user.name,bookcar.codeCar,bookcar.startPos,bookcar.endPos,bookcar.costPay,bookcar.status,bookcar.created_at,bookcar.id
    FROM  bookcar
    Join user ON user.id = bookcar.iduser
    where bookcar.status=2
    order by bookcar.id");
    $data_start = array();
    while ($row = mysqli_fetch_assoc($qr)) {
        array_push($data_start, $row);
    }
    $qr = mysqli_query($con, "SELECT user.name,bookcar.codeCar,bookcar.startPos,bookcar.endPos,bookcar.costPay,bookcar.status,bookcar.created_at,bookcar.id
    FROM  bookcar
    Join user ON user.id = bookcar.iduser
    where bookcar.status=3
    order by bookcar.id");
    $data_done = array();
    while ($row = mysqli_fetch_assoc($qr)) {
        array_push($data_done, $row);
    }

    //     if (isset($_GET['id'])) {
    //         $id = $_GET['id'];
    //         $qr = mysqli_query($con, "UPDATE chat_message SET status_mes=1 WHERE id=$id");
    //         if($qr){
    //             header("Location:chatmessage.php");
    //         }
    //     }
    // $update = false;

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Dashboard</title>

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
        <link href="chat.css" rel="stylesheet">

    </head>

    <body>
        <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="teacher_dasboard.php"> Admin</a>
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



                    <ul class="nav nav-tabs">
                        <li class="active"><a class="btn btn-info" href="#send">Chuyến xe đã đặt</a></li>
                        <li><a class="btn btn-info" href="#cancel">Chuyến xe hủy</a></li>
                        <li><a class="btn btn-info" href="#happen">Chuyến xe đang thực hiện</a></li>
                        <li><a class="btn btn-info" href="#done">Chuyến xe hoàn thành</a></li>

                    </ul>

                    <div class="tab-content">
                        <div id="send" class="tab-pane fade in active">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" style="text-align: center;">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Người đặt</th>
                                            <th>Chi phí</th>
                                            <th>Điểm đi</th>
                                            <th>Điểm đến</th>
                                            <th>Thời gian đặt</th>

                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        foreach ($data_booking as $d) {
                                        ?>
                                            <tr>
                                                <td><?php echo ++$count; ?></td>
                                                <td><?php echo $d['name']; ?></td>
                                                <td><?php echo $d['costPay']; ?></td>
                                                <td><?php echo $d['startPos']; ?></td>
                                                <td><?php echo $d['endPos']; ?></td>
                                                <td><?php echo $d['created_at']; ?></td>
                                                <td><a class="btn btn-info" name="seenmes" href="edit_bookcar.php?id=<?php echo $d['id']; ?>">
                                                        Duyệt</a>

                                                </td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="cancel" class="tab-pane fade">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" style="text-align: center;">
                                    <thead>
                                        <tr>

                                            <th>STT</th>
                                            <th>Người đặt</th>
                                          
                                            <th>Chi phí</th>
                                            <th>Điểm đi</th>
                                            <th>Điểm đến</th>
                                            <th>Thời gian đặt</th>
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        foreach ($data_cancel as $d) {
                                        ?>
                                            <tr>
                                                <td><?php echo ++$count; ?></td>
                                                <td><?php echo $d['name']; ?></td>
                                                <td><?php echo $d['costPay']; ?></td>
                                                <td><?php echo $d['startPos']; ?></td>
                                                <td><?php echo $d['endPos']; ?></td>
                                                <td><?php echo $d['created_at']; ?></td>
                                               

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="happen" class="tab-pane fade">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" style="text-align: center;">
                                    <thead>
                                        <tr>

                                            <th>STT</th>
                                            <th>Người đặt</th>
                                            <th>Mã xe</th>
                                            <th>Chi phí</th>
                                            <th>Điểm đi</th>
                                            <th>Điểm đến</th>
                                            <th>Thời gian đặt</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        foreach ($data_start as $d) {
                                        ?>
                                            <tr>
                                            <td><?php echo ++$count; ?></td>
                                                <td><?php echo $d['name']; ?></td>
                                                <td><?php echo $d['codeCar']; ?></td>
                                                <td><?php echo $d['costPay']; ?></td>
                                                <td><?php echo $d['startPos']; ?></td>
                                                <td><?php echo $d['endPos']; ?></td>
                                                <td><?php echo $d['created_at']; ?></td>
                                                <td><a class="btn btn-info" name="done" href="add_bookcar_post.php?iddone=<?php echo $d['id']; ?>">
                                                        Đến điểm đến</a>
                                                </td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="done" class="tab-pane fade">
                            <div class="table-responsive">
                                <table class="table table-striped table-sm" style="text-align: center;">
                                    <thead>
                                        <tr>

                                            <th>STT</th>
                                            <th>Người đặt</th>
                                            <th>Mã xe</th>
                                            <th>Chi phí</th>
                                            <th>Điểm đi</th>
                                            <th>Điểm đến</th>
                                            <th>Thời gian đặt</th>
                                            <th>Trạng thái</th>
                                         
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        foreach ($data_done as $d) {
                                        ?>
                                            <tr>
                                            <td><?php echo ++$count; ?></td>
                                                <td><?php echo $d['name']; ?></td>
                                                <td><?php echo $d['codeCar']; ?></td>
                                                <td><?php echo $d['costPay']; ?></td>
                                                <td><?php echo $d['startPos']; ?></td>
                                                <td><?php echo $d['endPos']; ?></td>
                                                <td><?php echo $d['created_at']; ?></td>
                                                <td>Hoàn thành</td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <hr>




                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
        </script>
        <script>
            $(document).ready(function() {
                $(".nav-tabs a").click(function() {
                    $(this).tab('show');
                });
                $('.nav-tabs a').on('shown.bs.tab', function(event) {
                    var x = $(event.target).text(); // active tab
                    var y = $(event.relatedTarget).text(); // previous tab
                    $(".act span").text(x);
                    $(".prev span").text(y);
                });
            });
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
<?php
} else {
    header("Location:login.php?error=UnAuthorized Access");
}
