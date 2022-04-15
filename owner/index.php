<?php
$conn=mysqli_connect("localhost","root","DVN9vpxEQLQEtD","db_Restoran");
session_start();
if(!empty($_SESSION['username'])){
    $user=$_SESSION['username'];
    $Cari=mysqli_query($conn,"select * from t_user where username='$user'");
    $akun=mysqli_fetch_array($Cari);
    if($akun[4]==6){
    ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link href="../gambar/Logo.png" rel="shortcut icon">
            <title>Aplikasi Restoran | Owner</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" media="screen" href="../assets/w3.css" />
            <link rel="stylesheet" href="../assets/style.css">
            <link rel="stylesheet" href="../assets/animate.css-master/animate.min.css">
            <link rel="stylesheet" href="../assets/bootstrap-4.1.3-dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
            <script src="../assets/jquery.js"></script>
            <script src="../assets/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>

        </head>

        <body>
            <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                <a class="navbar-brand judul" href="?page=home">
                    <strong class="judul">Dashboard Owner</strong>
                </a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="?page=home"><i class="fa fa-home" aria-hidden="true"></i> Beranda<span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="?page=setting"><i class="fa fa-cogs" aria-hidden="true"></i> Pengaturan</a>
                        </li>
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="fa fa-bar-chart" aria-hidden="true"></i> Laporan</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="?page=laporan&apa=user"><i class="fa fa-group" aria-hidden="true"></i>
                                    Lap. Registrasi</a>
                                <a class="dropdown-item" href="?page=laporan&apa=menu"><i class="fa fa-book" aria-hidden="true"></i>
                                    Lap. Referensi</a>
                                <a class="dropdown-item" href="?page=laporan&apa=order"><i class="fa fa-clipboard" aria-hidden="true"></i>
                                    Lap. Order</a>
                                <a class="dropdown-item" href="?page=laporan&apa=transaksi"><i class="fa fa-calculator" aria-hidden="true"></i>
                                    Lap.
                                    Transaksi</a>
                            </div>
                        </li>
                        <li class="nav-item w3-hide-large">
                            <p class="text-capitalize pull-left w3-text-white">
                                <i class="fa fa-refresh fa-spin" aria-hidden="true"></i>
                                <?php echo $akun[3];?>
                            </p>
                            <a href="../logout.php" class="w3-text-white pull-right" onclick="return confirm('Yakin Ingin Keluar..?')">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container w3-margin-top">
                <div class="row">
                    <div class="col-lg-3 animated fadeInLeft">
                        <div class="card border-success w3-hide-small" style="padding: 5px">
                            <img class="card-img-top" src="../gambar/Logo.png" alt="">
                            <div class="card-body text-center">
                                <h4 class="card-title w3-text-green">Selamat Datang</h4>
                                <p class="card-text w3-text-light-green text-capitalize"><i class="fa fa-refresh fa-spin" aria-hidden="true"></i>
                                    <?php echo $akun[3]?></p>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-outline-success btn-block my-2 my-sm-0" href="../logout.php" onclick="return confirm('Apakah Anda Yakin Ingin Keluar')">Logout</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <?php
                        error_reporting('page');
                        $page=htmlentities($_GET['page']);
                        $hal="$page.php";
                        if(!file_exists($hal)){
                            require "home.php";
                        }else{
                            include "$hal";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </body>

        </html>
    <?php
    }elseif($akun[4]==1 OR $akun[4]==2){
        ?><script>document.location='../pelanggan/index.php?page=home';</script><?php
    }elseif($akun[4]==3){
        ?><script>document.location='../waiter/index.php?page=home';</script><?php
    }elseif($akun[4]==4){
        ?><script>document.location='../kasir/index.php?page=home';</script><?php
    }elseif($akun[4]==5){
        ?><script>document.location='../admin/index.php?page=home';</script><?php
    }else{
        header('location:../index.php');
    }
}else{
    header('location:../index.php');
}