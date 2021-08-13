<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="gambar/Logo.png" rel="shortcut icon">
    <title>Aplikasi Restoran | Login </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/w3.css" />
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/animate.css-master/animate.min.css">
    <link rel="stylesheet" href="assets/bootstrap-4.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="assets/jquery.js"></script>
    <script src="assets/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="card col-lg-5 animated slideInDown kotak">
            <h1 class="text-center judul fa-4x">Restoran</h1>
            <img src="gambar/Logo.png" alt="logo" class="card-img-top" style="width:75%; margin:auto;">
            <div class="card-body">
                <form name="login" method="post">
                    <input type="text" name="username" placeholder="Username" class="w3-input" required>
                    <div class="batas"></div>
                    <input type="password" name="pass" placeholder="Password" class="w3-input" required>
                    <div class="batas"></div>
                    <hr>
                    <button type="submit" name="login" class="btn btn-primary pull-left">
                        <i class="fa fa-sign-in"></i> Login
                    </button>
                    <a href="index.php" class="btn btn-danger pull-right">
                        <i class="fa fa-backward"></i> Kembali
                    </a>
                </form>
                <?php
                    $conn=mysqli_connect("localhost","root","","db_Restoran");
                    if(isset($_POST['login'])){
                        $a=$_POST['username'];
                        $b=$_POST['pass'];


                        $query=mysqli_query($conn,"select * from t_user where username='$a' and password='$b'");
                        $_SESSION['username']=$_REQUEST['username'];

                        $array=mysqli_fetch_array($query);

                        if($array[4]==2){
                            ?><script>document.location='pelanggan/index.php?page=order';</script><?php
                        }elseif($array[4]==3){
                            ?><script>document.location='waiter/index.php?page=home';</script><?php
                        }elseif($array[4]==4){
                            ?><script>document.location='kasir/index.php?page=home';</script><?php
                        }elseif($array[4]==5){
                            ?><script>document.location='admin/index.php?page=home';</script><?php
                        }elseif($array[4]==6){
                            ?><script>document.location='owner/index.php?page=home';</script><?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>

</html>