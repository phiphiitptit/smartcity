<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {


    $id = $_SESSION['user_data']['id'];
    
    $qr = mysqli_query($con, "SELECT user.name,bookcar.costPay,bookcar.status,bookcar.id,bookcar.doneCost, SUM(bookcar.costPay) sumPay,Month(bookcar.created_at) mon,YEAR(bookcar.created_at) yearr
         FROM  bookcar
         Join user ON user.id = bookcar.iduser
         where bookcar.status = 3
         GROUP BY bookcar.iduser,mon,yearr
        order by mon");
//     if (isset($_POST['select'])){
//         $montht = mysqli_real_escape_string($con, $_REQUEST['month']);
// $yeart = mysqli_real_escape_string($con, $_REQUEST['year']);

// $qr = mysqli_query($con, "SELECT user.name, SUM(bookcar.costPay) sumPay,Month(bookcar.created_at) mon,YEAR(bookcar.created_at) yearr
//      FROM  bookcar
//      Join user ON user.id = bookcar.iduser
//      where bookcar.status = 3 and Month(bookcar.created_at)='".$montht."' and YEAR(bookcar.created_at)='".$yeart."'
//      GROUP BY bookcar.iduser,mon,yearr
//     order by mon");
//     }
    $data_pending = array();
    $count = 0;
    while ($row = mysqli_fetch_assoc($qr)) {
        array_push($data_pending, $row);
    }

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
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="admin_dashboard.php"> Admin</a>
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
                <form action="exportfile.php" method="post">
                    <div class="booking">
                        <br><br>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="inputName">Tháng</label>
                                <select name="month" class="form-control">
                                    <option value="0">--Chọn tháng--</option>
                                    <?php
                                   for ($i = 1; $i <= 12; $i++) {
                                    ?>

                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputName">Năm</label>
                                <select name="year" class="form-control">
                                    <option value="0">--Chọn năm--</option>
                                    <?php
                                      for ($i = 2019; $i <= 2021; $i++) {
                                    ?>

                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <!-- <button class="btn btn-sm btn-dark" type="submit" name="select">Lọc</button> -->
                        <button class="btn btn-sm btn-dark" type="submit" name="export">Xuất File</button>


                    </div>

                </form>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Người đặt</th>
                                    <th>Chi phí</th>
                                    <th>
                                        Tháng
                                    </th>
                                 
                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                foreach ($data_pending as $d) {
                                ?>
                                    <tr>
                                        <td><?php echo ++$count; ?></td>
                                        <td><?php echo $d['name']; ?></td>
                                        <td><?php echo $d['sumPay']; ?></td>
                                        <td><?php echo $d['mon']; ?></td>
                                       
                                        <!-- <td><a class="btn btn-info" name="seenmes" href="edit_bookcar.php?id=<?php echo $d['id']; ?>">
                                                        Duyệt</a>

                                                </td> -->

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
