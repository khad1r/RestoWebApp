<link rel="stylesheet" href="../assets/select2/css/select2.min.css">

<nav class="breadcrumb">
    <a class="breadcrumb-item" href="?page=home"><i class="fa fa-home" aria-hidden="true"></i> Beranda</a>
    <span class="breadcrumb-item active">Order</span>
</nav>

<?php
if(isset($_GET['id'])){
    ?>
    <a href="?page=order" class="btn btn-sm btn-danger animated fadeIn">Kembali</a>
    <?php
}

if(!isset($_GET['id'])){
    ?>
    <button class="btn btn-sm btn-success animated fadeIn" onclick="document.getElementById('tambah').style.display='block';">
        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
    </button>

    <div class="batas"></div>

    <form name="tambah" method="post">
        <div class="w3-modal" id="tambah">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="close" onclick="document.getElementById('tambah').style.display='none';">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <select required name="meja" class="w3-input pilih" id="pilih" style="width:100%;">
                            <option disabled selected>Pilih Meja</option>
                            <option value="1">Meja No 1</option>
                            <option value="2">Meja No 2</option>
                            <option value="3">Meja No 3</option>
                            <option value="4">Meja No 4</option>
                            <option value="5">Meja No 5</option>
                            <option value="6">Meja No 6</option>
                            <option value="7">Meja No 7</option>
                            <option value="8">Meja No 8</option>
                            <option value="9">Meja No 9</option>
                            <option value="10">Meja No 10</option>
                            <option value="11">Meja No 11</option>
                            <option value="12">Meja No 12</option>
                            <option value="13">Meja No 13</option>
                            <option value="14">Meja No 14</option>
                            <option value="15">Meja No 15</option>
                        </select>
                        <div class="batas"></div>

                        <div class="row">
                            <div class="col-6">
                                <input type="radio" name="member" checked value="bukan" onchange="$('#bukan_member').addClass('active');$('#member').removeClass('active')">
                                Bukan Member
                            </div>
                            <div class="col-6">
                                <input type="radio" name="member" value="member" onchange="$('#member').addClass('active');$('#bukan_member').removeClass('active')">
                                Member
                            </div>
                        </div>
                        
                        <div class="tab-content">
                            <div id="bukan_member" class="container tab-pane active"><br>
                                <input type="text" name="nama_user" placeholder="Nama" class="w3-input" >
                            </div>
                            <div id="member" class="container tab-pane"><br>
                                <select required name="level" class="w3-input pilih" style="width:100%;">
                                    <Option>----Pilih----</Option>
                                    <?php
                                    $opsi=mysqli_query($conn,"select * from t_user where id_level='2'");
                                    while($dt=mysqli_fetch_array($opsi)){
                                        ?>
                                    <option value="<?php echo $dt[0]?>">
                                        <?php echo $dt[3]?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    
                        <div class="batas"></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="#" class="w3-button btn-sm btn-primary" rel=".clone" id="btnadd"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                            </div>
                        </div>

                        <div class="batas"></div>

                        <div class="clone row batas">
                            <div class="col-8">
                            <select required name="menu[]" class="pilih w3-input" style="width:100%;">
                                <option value="" disabled selected>Pilih Menu</option>
                                <optgroup label="Makanan">
                                    <?php
                                    $opsi=mysqli_query($conn,"select * from t_menu where jenis_menu='makanan'");
                                    while($dt=mysqli_fetch_array($opsi)){
                                        ?>
                                    <option value="<?php echo $dt[0]?>">
                                        <?php echo $dt[2]?>
                                    </option>
                                    <?php
                                    }?>
                                </optgroup>
                                <optgroup label="Minuman">
                                    <?php
                                    $opsi=mysqli_query($conn,"select * from t_menu where jenis_menu='minuman'");
                                    while($dt=mysqli_fetch_array($opsi)){
                                        ?>
                                    <option value="<?php echo $dt[0]?>">
                                        <?php echo $dt[2]?>
                                    </option>
                                    <?php
                                    }?>
                                </optgroup>
                            </select>
                            </div>
                            <input type="number" min="1" placeholder="Jumlah" name="jumlah[]" class="w3-input col-sm-2" Value="1">
                            <a class="btn btn-danger btnremove btn-sm w3-text-white"><i class="fa fa-trash" aria-hidden="true"></i>
                                Hapus
                            </a>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="tambah">
                            <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Save
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('tambah').style.display='none';"><i
                                class="fa fa-close" aria-hidden="true"></i>&nbsp;Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    

    if(isset($_POST['tambah'])){
        $meja=$_POST['meja'];
        $tanggal=date('d-m-Y');
        if($_POST['member']=='bukan'){
            $nama=$_POST['nama_user'];
            $date=date('dmY');
            $satu="Pelanggan".$date;
            $username=$satu."000";
            $carinya=$satu."%";
            $Cekuser=mysqli_query($conn,"select * From t_user where username like '$carinya' order by username desc limit 1");
            $user=mysqli_fetch_array($Cekuser);
            if($user==null){
                $username=$satu."000";
            }else{
                $ok1=$user[1];
                $ok1++;
                $username=$ok1;
            }
            $query=mysqli_query($conn,"Insert into t_user values('','$username','','$nama','1')");
            $cariid=mysqli_query($conn,"SELECT * from t_user where id_level='1' and id_user=(select max(id_user) from t_user)");
            $hasilcari=mysqli_fetch_array($cariid);
            $id_user=$hasilcari[0];
        }else{
            $id_user=$_POST['level'];
        }
        $orderan=mysqli_query($conn,"INSERT into t_order values('','$meja','$tanggal','$id_user','Belum Bayar')");
        if($orderan){
            $order=mysqli_fetch_array(mysqli_query($conn,"SELECT * from t_order where id_order=(SELECT max(id_order) from t_order)"));
            $id_order=$order[0];
            for($i = 0; $i <= count($_POST['menu'])-1;$i++){
                $menu=$_POST['menu'][$i];
                $jumlah=$_POST['jumlah'][$i];
                if(empty($jumlah)){
                    $jumlah=1;
                }
                $query=mysqli_query($conn,"insert into t_detail_order values('','$id_order','$menu','$jumlah','Waiting')");
                if($query){
                    $men=mysqli_query($conn,"select * from t_menu where id_menu='$menu'");
                    $nama_menu=mysqli_fetch_array($men);
                    ?>
                    <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Berhasil</strong> Menu <?php echo $nama_menu[2];?> Berhasil Dipesan.
                    </div>
                    <script>setTimeout('location.replace("?page=order")', 2000);</script>
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
                        <strong>Gagal</strong> Menu <?php echo $nama_menu[2];?> Gagal Dipesan.
                    </div>
                    <script>setTimeout('location.replace("?page=order")', 2000);</script>
                    <?php
                }
            }
        }else{
            ?>
            <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Gagal</strong> Orderan Gagal Ditambahkan.
            </div>
            <script>setTimeout('location.replace("?page=order")', 1750);</script>
            <?php
        }
    }
}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    $hapus=mysqli_query($conn,"delete from t_order where id_order='$id'");
    if($hapus){
        ?>
        <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Sukses</strong> Hapus Data Berhasil.
        </div>
        <script>setTimeout('location.replace("?page=order")', 1750);</script>
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
        <script>
            setTimeout('location.replace("?page=order")', 1750);
        </script>
        <?php
    }
}
?>

<div class="batas"></div>

<div class="table-responsive animated fadeIn">
    <table class="table table-hover">
        <thead class="small">
            <tr>
                <th>No.</th>
                <th>Id Order</th>
                <th>No. Meja</th>
                <th>Tanggal</th>
                <th>User</th>
                <th>Keterangan</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="small">
            <?php
            if(!isset($_GET['id'])){
                $tabel=mysqli_query($conn,"select * From t_order");
            }else{
                $id=$_GET['id'];
                $tabel=mysqli_query($conn,"select * From t_order where id_order=$id");
            }
            $no=1;
            while($dtable=mysqli_fetch_array($tabel)){
                $a=mysqli_query($conn,"select * From t_user where id_user='$dtable[3]'");
                $dtakses=mysqli_fetch_array($a);
                ?>
                <tr>
                    <td>
                        <?php echo $no++ ;?>
                    </td>
                    <td>
                        <?php echo $dtable[0];?>
                    </td>
                    <td>
                        <?php echo $dtable[1];?>
                    </td>
                    <td>
                        <?php echo $dtable[2];?>
                    </td>
                    <td>
                        <?php echo $dtakses[3];?>
                    </td>
                    <td>
                        <?php echo $dtable[4];?>
                    </td>
                    <td>
                        <?php
                        if(!isset($_GET['id'])){
                            ?>
                        <a href="?page=order&id=<?php echo $dtable[0];?>" title="Lihat Orderan">
                            <i class="fa fa-eye w3-text-blue" aria-hidden="true"></i>
                        </a>&nbsp;
                        <?php
                        }
                        if($dtable[4]=="Belum Bayar"){
                            ?>
                                <a href="?page=order&hapus=<?php echo $dtable[0];?>" title="Hapus Data" onclick="return confirm('Ingin Menghapus Data Dengan Id <?php echo $dtable[0];?>...?')">
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
        </tbody>
    </table>
</div>
<div class="batas"></div>

<?php
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $j=mysqli_query($conn,"select * From t_order where id_order=$id");
    $k=mysqli_fetch_array($j);

    if(!isset($_GET['edit']) and $k[4]=="Belum Bayar"){
        ?>
        <button class="btn btn-sm w3-teal animated fadeIn" onclick="document.getElementById('tambah').style.display='block';">
            <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
        </button>

        <div class="batas"></div>

        <form name="tambah" method="post">
            <div class="w3-modal" id="tambah">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Order</h5>
                                <button type="button" class="close" onclick="document.getElementById('tambah').style.display='none';">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="#" class="w3-button btn-sm btn-primary" rel=".clone" id="btnadd"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</a>
                                </div>
                            </div>
                            <div class="batas"></div>
                            <div class="clone row batas">
                                <div class="col-8">
                                <select required name="menu[]" class="pilih w3-input" style="width:100%;">
                                    <option value="" disabled selected>Pilih Menu</option>
                                    <optgroup label="Makanan">
                                        <?php
                                        $opsi=mysqli_query($conn,"select * from t_menu where jenis_menu='makanan'");
                                        while($dt=mysqli_fetch_array($opsi)){
                                            ?>
                                        <option value="<?php echo $dt[0]?>">
                                            <?php echo $dt[2]?>
                                        </option>
                                        <?php
                                        }?>
                                    </optgroup>
                                    <optgroup label="Minuman">
                                        <?php
                                        $opsi=mysqli_query($conn,"select * from t_menu where jenis_menu='minuman'");
                                        while($dt=mysqli_fetch_array($opsi)){
                                            ?>
                                        <option value="<?php echo $dt[0]?>">
                                            <?php echo $dt[2]?>
                                        </option>
                                        <?php
                                        }?>
                                    </optgroup>
                                </select>
                                </div>
                                <input type="number" min="1" placeholder="Jumlah" name="jumlah[]" class="w3-input col-sm-2" Value="1">
                                <a class="btn btn-danger btnremove btn-sm w3-text-white"><i class="fa fa-trash" aria-hidden="true"></i>
                                    Hapus
                                </a>
                            </div>
                        </div>
    
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="tambah">
                                <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Save
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('tambah').style.display='none';"><i
                                    class="fa fa-close" aria-hidden="true"></i>&nbsp;Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <?php
        if(isset($_POST['tambah'])){
            $id_order=$id;
            for($i = 0; $i <= count($_POST['menu'])-1;$i++){
                $menu=$_POST['menu'][$i];
                $jumlah=$_POST['jumlah'][$i];
                if(empty($jumlah)){
                    $jumlah=1;
                }
                $query=mysqli_query($conn,"insert into t_detail_order values('','$id_order','$menu','$jumlah','Waiting')");
                if($query){
                    $men=mysqli_query($conn,"select * from t_menu where id_menu='$menu'");
                    $nama_menu=mysqli_fetch_array($men);
                    ?>
                    <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Berhasil</strong> Menu <?php echo $nama_menu[2];?> Berhasil Dipesan.
                    </div>
                    <script>setTimeout('location.replace("?page=order&id=<?php echo $id;?>")', 2000);</script>
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
                        <strong>Gagal</strong> Menu <?php echo $nama_menu[2];?> Gagal Dipesan.
                    </div>
                    <script>setTimeout('location.replace("?page=order&id=<?php echo $id;?>")', 2000);</script>
                    <?php
                }
            }
        }
    }

    if(isset($_GET['edit'])){
        $id_edit=$_GET['edit'];
        $cari=mysqli_query($conn,"select * from t_detail_order where id_detail_order='$id_edit'");
        $data=mysqli_fetch_array($cari);
        ?>
        <form name="edit" method="post">
            <div class="card animated fadeIn">
                <div class="card-header">
                    <h6 class="card-title">Edit Data</h6>
                </div>
                <div class="card-body">
                    <div class="row batas">
                        <?php
                            $opsi=mysqli_query($conn,"select * from t_menu where id_menu='$data[2]'");
                            $dt=mysqli_fetch_array($opsi);
                        ?>
                        <input type="text" class="w3-input col-6" Value="<?php echo $dt[2] ?>" readonly>
                        <div class="col-1"></div>
                        <input type="number" min="1" placeholder="Jumlah" name="jumlah" class="w3-input col-1" Value="<?php echo $data[3] ?>">
                        <div class="col-1"></div>
                        <select name="status" class="w3-input col-3">
                            <option value="<?php echo $data[4] ?>"><?php echo $data[4] ?></option>
                            <option value="Ready">Ready</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="edit" class="btn btn-sm btn-primary">
                        <i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Update
                    </button>
                    <a href="?page=order&id=<?php echo $id;?>" class="btn btn-sm btn-danger">
                        <i class="fa fa-close" aria-hidden="true"></i>&nbsp;Batal
                    </a>
                </div>
            </div>
        </form>
        
        <?php
        if(isset($_POST['edit'])){
            $jumlah=$_POST['jumlah'];
            $status=$_POST['status'];
            $simpan=mysqli_query($conn,"update t_detail_order set jumlah='$jumlah', status='$status' where id_detail_order='$id_edit'");
            if($simpan){
                ?>
                <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Sukses</strong> Update Pesanan Berhasil.
                </div>
                <script>setTimeout('location.replace("?page=order&id=<?php echo $id;?>")', 1750);</script>
                <?php
            }else{
                ?>
                <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Gagal</strong> Update Pesanan Gagal.
                </div>
                <script>setTimeout('location.replace("?page=order&id=<?php echo $id;?>")', 1750);</script>
                <?php
            }
        }
    }

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
            <script>setTimeout('location.replace("?page=order&id=<?php echo $id;?>")', 2000);</script>
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
            <script>setTimeout('location.replace("?page=order&id=<?php echo $id;?>")', 2000);</script>
            <?php
        }
    }

    ?>

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
                                    <a href="?page=order&id=<?php echo $id;?>&edit=<?php echo $dtable[0];?>" title="Edit Data">
                                        <i class="fa fa-edit w3-text-green" aria-hidden="true"></i>
                                    </a>&nbsp;
                                    <a href="?page=order&id=<?php echo $id;?>&hapus_order=<?php echo $dtable[0];?>" title="Hapus Data" onclick="return confirm('Ingin Menghapus Pesanan <?php echo $d[2];?>...?')">
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

<script src="../assets/select2/js/select2.full.min.js"></script>
<script src="../assets/relcopy.js"></script>
<script>
    $(document).ready(function () {
        $('.pilih').select2();

        $('a#btnadd').relCopy();

        var i = 0;
        $('a.btnremove').hide();

        $('#btnadd').click(function(){
            i++;
            $('a.btnremove').show(function(){ $(this).slideDown() });
        });

        $('.btnremove').click(function(){
            $(this).parent().slideUp(function(){ $(this).remove() }); 
            --i;
            if(i == 0){
                $('a.btnremove').hide(function(){ $(this).slideUp() });
            };
            return false
        });
    });
</script>