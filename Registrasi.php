<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="gambar/Logo.png" rel="shortcut icon">
    <title>Aplikasi Restoran | Registrasi</title>
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
                <div class="text-center">
                    <form name="regis" method="post">
                        <input type="text" name="username" placeholder="Username" class="w3-input" required>
                        <div class="batas"></div>
                        <input type="text" name="nama_user" placeholder="Nama" class="w3-input" required>
                        <div class="batas"></div>
                        <input type="password" name="pass" placeholder="Password" class="w3-input" required>
                        <div class="batas"></div>
                        <input type="password" name="pass2" placeholder="Konfirmasi Password" class="w3-input" required>
                        <hr>
                        <button type="submit" name="regis" class="btn btn-primary pull-left">
                            <i class="fa fa-sign-in"></i> Registrasi
                        </button>
                        <a href="index.php" class="btn btn-danger pull-right">
                            <i class="fa fa-backward"></i> Kembali
                        </a>
                    </form>
                    <?php
                        $conn=mysqli_connect("localhost","root","","db_Restoran");
                        if(isset($_POST['regis'])){
                            $username=$_POST['username'];
                            $nama=$_POST['nama_user'];
                            $pass=$_POST['pass'];
                            $pass2=$_POST['pass2'];
                            $Cekuser=mysqli_query($conn,"select * From t_user where username='$username'");
                            $user=mysqli_fetch_array($Cekuser);
                            if($user==null){
                                if($pass==$pass2){
                                    $_SESSION['username']=$_REQUEST['username'];
                                    $query=mysqli_query($conn,"Insert into t_user values('','$username','$pass','$nama','2')");
                                    if($query){
                                        ?>
                                        <script>document.location='pelanggan/index.php?page=order';</script>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <strong>Oppss</strong> Registrasi Gagal.
                                        </div>
                                        <?php
                                    }
                                }else{
                                    ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="notificatons">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                        </button>
                                        <strong>Oppss</strong> Password tidak sama.
                                    </div>
                                    <?php
                                }
                            }else{
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="notificatons">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <strong>Oppss</strong> Username telah digunakan.
                                </div>
                                <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
