<div class="container kotak">
    <div class="card">
        <div class="card-header">
            <?php
            if(!isset($_GET['id'])){

                ?>
                <a class="btn btn-danger" href="?page=home" role="button">
                    Kembali
                </a>
                <?php

            }elseif(isset($_GET['id'])){

                ?>
                <a class="btn btn-danger" href="?page=history" role="button">
                    Kembali
                </a>
                <?php
            }
            ?>
        </div>
        <div class="card-body">

            <div class="table-responsive animated fadeIn">
                <table class="table table-hover">
                    <thead class="small">
                        <tr>
                            <th>No.</th>
                            <th>No. Meja</th>
                            <th>Tanggal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <?php
                        if(!isset($_GET['id'])){
                            $tabel=mysqli_query($conn,"select * From t_order where id_user='$akun[0]'");
                        }else{
                            $id=$_GET['id'];
                            $tabel=mysqli_query($conn,"select * From t_order where id_order=$id");
                        }
                        $no=1;
                        while($dtable=mysqli_fetch_array($tabel)){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $no++ ;?>
                                </td>
                                <td>
                                    <?php echo $dtable[1];?>
                                </td>
                                <td>
                                    <?php echo $dtable[2];?>
                                </td>
                                <td>
                                    <a href="?page=history&id=<?php echo $dtable[0];?>" title="Lihat Orderan">
                                        <i class="fa fa-eye w3-text-blue" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="batas"></div>

            <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];
                $j=mysqli_query($conn,"select * From t_order where id_order=$id");
                $k=mysqli_fetch_array($j);
                
                if(isset($_GET['hapus_order'])){
                    $id_detail=$_GET['hapus_order'];
                    $cari=mysqli_query($conn,"select * from t_detail_order where id_detail_order='$id_detail'");
                    $data=mysqli_fetch_array($cari);
                    $menu=$data[2];
                    $hapus=mysqli_query($conn,"delete from t_detail_order where id_detail_order='$id_detail'");
                    if($hapus){
                        $men=mysqli_query($conn,"select * from t_menu where id_menu='$menu'");
                        $nama_menu=mysqli_fetch_array($men);
                        ?>
                        <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Berhasil</strong> Pesanan <?php echo $nama_menu[2];?> Berhasil Dihapus.
                        </div>
                        <script>setTimeout('location.replace("?page=history&id=<?php echo $id;?>")', 2000);</script>
                        <?php
                    }else{
                        $men=mysqli_query($conn,"select * from t_menu where id_menu='$menu'");
                        $nama_menu=mysqli_fetch_array($men);
                        ?>
                        <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Gagal</strong> Pesanan <?php echo $nama_menu[2];?> Gagal Dihapus.
                        </div>
                        <script>setTimeout('location.replace("?page=history&id=<?php echo $id;?>")', 2000);</script>
                        <?php
                    }
                }
                ?>
                <a class="btn btn-sm w3-teal animated fadeIn" href="?page=order&id=<?php echo $id ;?>">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Order
                </a>
                <div class="batas"></div>

                <div class="batas"></div>

                <div class="table-responsive animated fadeIn">
                    <table class="table table-hover">
                        <thead class="small">
                            <tr>
                                <th>No.</th>
                                <th>Menu</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <tr>
                                <?php
                                $tabel=mysqli_query($conn,"select * From t_detail_order where id_order=$id");
                                $no=1;
                                while($dtable=mysqli_fetch_array($tabel)){
                                    $a=mysqli_query($conn,"select * From t_menu where id_menu='$dtable[2]'");
                                    $d=mysqli_fetch_array($a);
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $no++ ;?>
                                        </td>
                                        <td>
                                            <?php echo $d[2];?>
                                        </td>
                                        <td>
                                            <?php echo $dtable[3];?>
                                        </td>
                                        <td>
                                            <?php echo $dtable[4];?>
                                        </td>
                                        <td>
                                            <?php
                                            if($dtable[4]!=="Delivered"){
                                                ?>
                                                <a href="?page=history&id=<?php echo $id;?>&hapus_order=<?php echo $dtable[0];?>" title="Hapus Data" onclick="return confirm('Ingin Menghapus Pesanan <?php echo $d[2];?>...?')">
                                                    <i class="fa fa-trash w3-text-red" aria-hidden="true"></i>
                                                </a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</div>