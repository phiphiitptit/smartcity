<?php
session_start();
include 'config.php';
if (isset($_SESSION['user_data'])) {

    if ($_SESSION['user_data']['usertype'] != 1) {
        header("Location:user_dasboard.php");
    }
    $editinfo = false;
    $cost = "";
    $update = false;

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $update = true;
        $record = mysqli_query($con, "SELECT * FROM fee WHERE id=$id");
        if (count(array($record)) == 1) {
            $data = mysqli_fetch_array($record);
            $cost = $data['costPay'];
        }
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
            <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="admin_dashboard.php">Admin</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <ul class="navbar-nav ">

                <li class="nav-item">
                    <a class="nav-link " href="logout.php">Đăng xuất</a>
                </li>
            </ul>

        </nav>

        <div class="container-fluid">
            <div class="row">
                <?php include 'admin_menu.php' ?>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <?php if ($update != true and $editinfo != true) : ?>
                            <div class="btn-group mr-2">
                                <a class="btn btn-info" href="add_fee.php">
                                    Thêm Chi Phi</a>
                            </div>
                        <?php else : ?>
                            <div class="btn-group mr-2">
                                <a class="btn btn-info" href="pos_manager.php">
                                    Quay lại</a>
                            </div>
                        <?php endif ?>


                    </div>
                    <form action="add_fee_post.php" method="post">
                        <div class="row">
                            <?php if (isset($_REQUEST['error'])) { ?>
                                <div class="col-lg-12">
                                    <span class="alert alert-danger" style="display: block;"><?php echo $_REQUEST['error']; ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <?php if (isset($_REQUEST['success'])) { ?>
                                <div class="col-lg-12">
                                    <span class="alert alert-success" style="display: block;"><?php echo $_REQUEST['success']; ?></span>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-6">

                            <input type="hidden" class="form-control" name="id" value="<?php echo $id; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName">Điểm Bắt Đầu</label>
                            <select name="startPos" class="form-control">
                                <?php
                                foreach ($dataPos as $d) {
                                ?>

                                    <option value="<?php echo $d['addressPos']; ?>"><?php echo $d['addressPos'];?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName">Điểm Kết Thúc</label>
                            <select name="endPos" class="form-control">
                                <?php
                                foreach ($dataPos as $d) {
                                ?>

                                    <option value="<?php echo $d['addressPos']; ?>"><?php echo $d['addressPos'];?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputName">Chi Phi</label>
                            <input type="text" class="form-control" name="costPay" required="required" id="inputName" value="<?php echo $cost;?>">
                        </div>
                        <?php if ($update == true) : ?>
                            <button class="btn btn-primary col-md-6" type="submit" name="update" style="background: #556B2F;">Cập nhật</button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-primary col-md-6" name="save">Thêm chi phí</button>
                        <?php endif ?>

                    </form>
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
<?php
} else {
    header("Location:login.php?error=UnAuthorized Access");
}
