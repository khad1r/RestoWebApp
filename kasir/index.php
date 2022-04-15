<?php
$conn=mysqli_connect("localhost","root","DVN9vpxEQLQEtD","db_Restoran");
session_start();
if(!empty($_SESSION['username'])){
    $user=$_SESSION['username'];
    $Cari=mysqli_query($conn,"select * from t_user where username='$user'");
    $akun=mysqli_fetch_array($Cari);
    if($akun[4]==4){
        ?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link href="../gambar/Logo.png" rel="shortcut icon">
            <title>Aplikasi Restoran | Kasir</title>
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
            <nav class="navbar navbar-expand-sm navbar-dark bg-success">
                <a class="navbar-brand" href="?page=home">
                    <strong class="judul">Dashboard Kasir</strong>
                </a>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
                <a class="nav-link text-capitalize w3-text-white" style="margin-right:20px;" href="?page=setting">
                    <i class="fa fa-wrench" aria-hidden="true"></i>
                    <?php echo $akun[3];?>
                </a>
                <a href="../logout.php" class="pull-right nav-item nav-link btn btn-danger navbar-btn" onclick="return confirm('Yakin Ingin Keluar..?')">
                    <i class="fa fa-sign-out" aria-hidden="true"></i> Logout
                </a>
            </nav>

            <div class="row" style="height:40px;"></div>

            <div class="container w3-margin-top kotak">
                <?php
                    error_reporting('page');
                    $page= htmlentities($_GET['page']);
                    $hal="$page.php";
                    if(!file_exists($hal)){
                        require "home.php";
                    }else{
                        include "$hal";
                    }
                ?>
            </div>
        </body>

        </html>

        <?php
    }elseif($akun[4]==1 or $akun[4]==2){
        ?><script>document.location='../pelanggan/index.php?page=home';</script><?php
    }elseif($akun[4]==3){
        ?><script>document.location='../waiter/index.php?page=home';</script><?php
    }elseif($akun[4]==4){
        ?><script>document.location='../admin/index.php?page=home';</script><?php
    }elseif($akun[4]==6){
        ?><script>document.location='../owner/index.php?page=home';</script><?php
    }else{
        header('location:../index.php');
    }
}else{
    header('location:../index.php');
}