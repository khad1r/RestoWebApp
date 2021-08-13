<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../gambar/Logo.png" rel="shortcut icon">
    <title>Aplikasi Restoran | Print</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../assets/w3.css" />
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/animate.css-master/animate.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-4.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../assets/jquery.js"></script>
    <script src="../assets/bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    <script src="../assets/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".uang").mask("000,000,000,000,000.000", {reverse:true});
        }); 
    </script>
</head>

<body onload="window.print()">

<div class="container w3-margin-top">
        <div class="row">
            <div class="col-2"></div>

            <div class="col-8">
                <?php
                $conn=mysqli_connect("localhost","root","","db_Restoran");
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $cari=mysqli_query($conn,"select * from t_order where id_order='$id'");
                    $data=mysqli_fetch_array($cari);
                }?>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4"><p class="card-text">Id Order</p></div>
                            <div class="col-8"><p class="card-text"><?php echo $data[0];?></p></div>
                        </div>
                        <div class="batas"></div>
                        <div class="row">
                            <div class="col-4"><p class="card-text">No. Meja</p></div>
                            <div class="col-8"><p class="card-text"><?php echo $data[1];?></p></div>
                        </div>
                        <div class="batas"></div>
                        <div class="row">
                            <div class="col-4"><p class="card-text">Tanggal</p></div>
                            <div class="col-8"><p class="card-text"><?php echo $data[2];?></p></div>
                        </div>
                        <div class="batas"></div>
                        <div class="row">
                            <div class="col-4"><p class="card-text">User</p></div>
                            <?php 
                                $u=mysqli_query($conn,"select * from t_user where id_user='$data[3]'");
                                $user=mysqli_fetch_array($u); 
                            ?>
                            <div class="col-8"><p class="card-text"><?php echo $user[3];?></p></div>
                        </div>
                        <div class="batas"></div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <p class="card-text">Daftar Order</p>
                            </div>
                        </div>
                        <div class="batas"></div>
                        <div class="row">
                            <div class="col-1">No.</div>
                            <div class="col-5">Menu</div>
                            <div class="col-2">Jumlah</div>
                            <div class="col-4">Harga</div>
                        </div>
                        <?php
                            $total=0;
                            $order=mysqli_query($conn,"select * from t_detail_order where id_order='$id'");
                            $no=1;
                            while($o=mysqli_fetch_array($order)){
                                ?>
                                <div class="batas"></div>
                                <div class="row">
                                    <div class="col-1"><?php echo $no++;?></div>
                                    <?php 
                                    $a=mysqli_query($conn,"select * From t_menu where id_menu='$o[2]'");
                                    $d=mysqli_fetch_array($a); 
                                    ?>
                                    <div class="col-5"><?php echo $d[2];?></div>
                                    <div class="col-2"><?php echo $o[3];?></div>
                                    <?php
                                    $harga=$d[3]*$o[3];
                                    $total=$total+$harga
                                    ?>
                                    <div class="col-4">
                                        <div class="row">
                                            <div class="col-4">Rp.</div>
                                            <div class="col-8"><div class="uang"><?php echo $harga;?></div></div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        <div class="batas"></div>
                        <hr>
                        <div class="row">
                            <div class="col-8">
                                <p class="card-text h3">Total</p>
                            </div>
                            <div class="col-4 h3">
                                <div class="row">
                                    <div class="col-4">Rp.</div>
                                    <div class="col-8"><div class="uang"><?php echo $total;?></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-2"></div>
        </div>
    </div>
</body>

</html>