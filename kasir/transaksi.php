<div class="card">

    <div class="card-header">
    <?php 
    if(!isset($_GET['bayar'])){
        ?>
        <a class="btn btn-danger" href="?page=home" role="button">
            Kembali
        </a>
        <?php
    }elseif(isset($_GET['bayar'])){
        ?>
        <a class="btn btn-danger" href="?page=transaksi" role="button">
            Kembali
        </a>
        <?php
    } ?>
    </div>

    <div class="card-body">
        <?php
        if(isset($_GET['bayar'])){
            $id=$_GET['bayar'];
            $cari=mysqli_query($conn,"select * from t_order where id_order='$id'");
            $data=mysqli_fetch_array($cari);
            ?>

            <form name="bayar" method="post">
                <div class="card animated fadein">
                    <div class="card-header">
                        <h6 class="card-title">Pembayaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4"><p class="card-text">Id Order</p></div>
                            <div class="col-lg-8"><p class="card-text"><?php echo $data[0];?></p></div>
                        </div>
                        <div class="batas"></div>
                        <div class="row">
                            <div class="col-lg-4"><p class="card-text">No. Meja</p></div>
                            <div class="col-lg-8"><p class="card-text"><?php echo $data[1];?></p></div>
                        </div>
                        <div class="batas"></div>
                        <div class="row">
                            <div class="col-lg-4"><p class="card-text">Tanggal</p></div>
                            <div class="col-lg-8"><p class="card-text"><?php echo $data[2];?></p></div>
                        </div>
                        <div class="batas"></div>
                        <div class="row">
                            <div class="col-lg-4"><p class="card-text">User</p></div>
                            <?php 
                                $u=mysqli_query($conn,"select * from t_user where id_user='$data[3]'");
                                $user=mysqli_fetch_array($u); 
                            ?>
                            <div class="col-lg-8"><p class="card-text"><?php echo $user[3];?></p></div>
                        </div>
                        <div class="batas"></div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="card-text">Daftar Order</p>
                            </div>
                        </div>
                        <div class="batas"></div>
                        <div class="row">
                            <div class="col-lg-1">No.</div>
                            <div class="col-lg-5">Menu</div>
                            <div class="col-lg-2">Jumlah</div>
                            <div class="col-lg-4">Harga</div>
                        </div>
                        <?php
                            $total=0;
                            $order=mysqli_query($conn,"select * from t_detail_order where id_order='$id'");
                            $no=1;
                            while($o=mysqli_fetch_array($order)){
                                ?>
                                <div class="batas"></div>
                                <div class="row">
                                    <div class="col-lg-1"><?php echo $no++;?></div>
                                    <?php 
                                    $a=mysqli_query($conn,"select * From t_menu where id_menu='$o[2]'");
                                    $d=mysqli_fetch_array($a); 
                                    ?>
                                    <div class="col-lg-5"><?php echo $d[2];?></div>
                                    <div class="col-lg-2"><?php echo $o[3];?></div>
                                    <?php
                                    $harga=$d[3]*$o[3];
                                    $total=$total+$harga
                                    ?>
                                    <div class="col-lg-4">
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
                            <div class="col-lg-8">
                                <p class="card-text h3">Total</p>
                            </div>
                            <div class="col-lg-4 h3">
                                <div class="row">
                                    <div class="col-4">Rp.</div>
                                    <div class="col-8"><div class="uang"><?php echo $total;?></div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" name="bayar" class="btn btn-sm btn-primary">
                            <i class="fa fa-calculator" aria-hidden="true"></i> Bayar
                        </button>
                        <a href="print_transaksi.php?id=<?php echo $id ?>" target="_blank" class="btn btn-sm btn-secondary">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print
                        </a>
                        <a href="?page=transaksi" class="btn btn-sm btn-danger">
                            <i class="fa fa-close" aria-hidden="true"></i>&nbsp;Batal
                        </a>
                    </div>
                </div>
            </form>

            <?php
            if(isset($_POST['bayar'])){
                $id_user=$data[3];
                $id_order=$data[0];
                $tanggal=date('d-m-Y');
                $simpan=mysqli_query($conn,"insert into t_transaksi values('','$id_user','$id_order','$tanggal','$total')");
                if($simpan){
                    $update=mysqli_query($conn,"UPDATE t_order set keterangan='Telah Dibayar' where id_order='$id_order'");
                    ?>
                    <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Sukses</strong> Pembayaran Berhasil.
                    </div>
                    <script>setTimeout('location.replace("?page=transaksi")', 1750);</script>
                    <?php
                }else{
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Gagal</strong> Pembayaran Gagal.
                    </div>
                    <script>setTimeout('location.replace("?page=transaksi")', 1750);</script>
                    <?php
                }
            }
        }

        if(isset($_GET['hapus'])){
            $id=$_GET['hapus'];
            $cari=mysqli_query($conn,"select * from t_transaksi where id_transaksi='$id'");
            $data=mysqli_fetch_array($cari);
            $id_order=$data[2];
            $hapus=mysqli_query($conn,"delete from t_transaksi where id_transaksi='$id'");
            $hapus2=mysqli_query($conn,"delete from t_order where id_order='$id_order'");
            if($hapus and $hapus2){
                ?>
                <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Sukses</strong> Hapus Data Berhasil.
                </div>
                <script>setTimeout('location.replace("?page=transaksi")', 1750);</script>
                <?php
            }else{
                ?>
                <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Gagal</strong> Hapus Data Gagal.
                </div>
                <script>setTimeout('location.replace("?page=transaksi")', 3000);</script>
                <?php
            }
        }

        if(!isset($_GET['bayar'])){
            ?>
            <h5>Tabel Belum Bayar</h5>
            <hr>
            <div class="table-responsive animated fadein">
                <table class="table table-striped">
                    <thead class="small">
                        <tr>
                            <th>No.</th>
                            <th>Id Order</th>
                            <th>Tanggal</th>
                            <th>User</th>
                            <th>Keterangan</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <?php
                        if(!isset($_GET['id'])){
                            $tabel=mysqli_query($conn,"select * From t_order where keterangan='Belum Bayar'");
                            while($dtable=mysqli_fetch_array($tabel)){
                                $no=1;
                                $a=mysqli_query($conn,"select * From t_user where id_user='$dtable[3]'");
                                $dtakses=mysqli_fetch_array($a);
                                ?>
                                <tr>
                                    <td><?php echo $no++ ;?></td>
                                    <td><?php echo $dtable[0];?></td>
                                    <td><?php echo $dtable[2];?></td>
                                    <td><?php echo $dtakses[3];?></td>
                                    <td><?php echo $dtable[4];?></td>
                                    <td>
                                        <a href="?page=transaksi&bayar=<?php echo $dtable[0];?>" class="btn btn-block w3-red">
                                            <i class="fa fa-calculator" aria-hidden="true"></i>  Bayar
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="batas"></div>
            
            <h5>Tabel Transaksi</h5>
            <hr>
            <div class="table-responsive animated fadein">
                <table class="table table-striped">
                    <thead class="small">
                        <tr>
                            <th>No.</th>
                            <th>Id Order</th>
                            <th>User</th>
                            <th>Tanggal</th>
                            <th>Total Bayar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <?php
                        $tabel=mysqli_query($conn,"select * From t_transaksi");
                        $no=1;
                        while($dtable=mysqli_fetch_array($tabel)){
                            $a=mysqli_query($conn,"select * From t_user where id_user='$dtable[1]'");
                            $d=mysqli_fetch_array($a);
                            ?>
                            <tr>
                                <td><?php echo $no++ ;?></td>
                                <td><?php echo $dtable[2];?></td>
                                <td><?php echo $d[3];?></td>
                                <td><?php echo $dtable[3];?></td>
                                <td><p class="uang"><?php echo $dtable[4];?></p></td>
                                <td>
                                    <a href="?page=transaksi&hapus=<?php echo $dtable[0];?>" title="Hapus Data" onclick="return confirm('Apakah Anda Ingin Menghapus Seluruh Transaksi Ini...?')">
                                        <i class="fa fa-trash w3-text-red" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        }
        ?>
    </div>

</div>


<script src="../assets/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $(".uang").mask("000.000.000.000.000.000", {reverse:true});
    }); 
</script>