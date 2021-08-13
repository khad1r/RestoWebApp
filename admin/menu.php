<nav class="breadcrumb">
    <a class="breadcrumb-item" href="?page=home"><i class="fa fa-home" aria-hidden="true"></i> Beranda</a>
    <span class="breadcrumb-item active">Referensi Menu</span>
</nav>

<div id="modalimg" class="w3-modal text-center" onclick="this.style.display='none';" style="pading:50px">
    <div class="w3-modal-content w3-animate-zoom" style="width:500px">
        <img src="" alt="" id="zoom" class="img-thumbnail img-fluid" style="width:100%">
    </div>
</div>


<?php
if(!isset($_GET['edit'])){
    ?>
    <button type="button" class="btn btn-success btn-sm animated fadeIn" onclick="document.getElementById('tambah').style.display='block';">
        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
    </button>
    <div class="batas"></div>
    <form name="tambah" method="post" enctype="multipart/form-data">
        <!-- Modal -->
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
                        <select name="jenis" class="w3-input">
                            <option value="">Pilih Jenis</option>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                        </select>
                        <div class="batas"></div>
                        <input type="text" name="nama_menu" class="w3-input" placeholder="Nama Menu" required>
                        <div class="batas"></div>
                        <input type="number" name="harga" class="w3-input uang" placeholder="Harga" required>
                        <div class="batas"></div>
                        <input type="text" name="status" class="w3-input" placeholder="Status Menu" required>
                        <div class="batas"></div>
                        <input type="file" name="gambar" class="w3-input" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="tambah"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Save</button>
                        <button type="button" class="btn btn-secondary" onclick="document.getElementById('tambah').style.display='none';"><i class="fa fa-close" aria-hidden="true"></i>&nbsp;Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
}

if(isset($_POST['tambah'])){
    $jenis=$_POST['jenis'];
    $nama=$_POST['nama_menu'];
    $harga=$_POST['harga'];
    $harga=str_replace(".","",$harga);
    $status=$_POST['status'];

    $gambarnama=$_FILES['gambar']['name'];
    $tmpgambar=$_FILES['gambar']['tmp_name'];
    $gambar=date('YmdHis').$gambarnama;
    $tujuan='../gambar/menu/'.$gambar;
    if(move_uploaded_file($tmpgambar,$tujuan)){
        $insert=mysqli_query($conn,"INSERT into t_menu Values('','$jenis','$nama','$harga','$status','$gambar')");
        if($insert){
            ?>
            <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Berhasil</strong> Data Berhasil Ditambahkan.
            </div>
            <script>setTimeout('location.replace("?page=menu")', 2000);</script>
            <?php
        }else{
            ?>
            <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Gagal</strong> Data Gagal Ditambahkan.
            </div>
            <script>setTimeout('location.replace("?page=menu")', 2000);</script>
            <?php
        }   
    }else{
        ?>
        <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Gagal</strong> Gambar Gagal Diupload.
        </div>
        <script>setTimeout('location.replace("?page=menu")', 2000);</script>
        <?php
    }
}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $cari=mysqli_query($conn,"select * from t_menu where id_menu='$id'");
    $data=mysqli_fetch_array($cari);
    if(isset($_POST['edit'])){
        $jenis=$_POST['jenis'];
        $nama=$_POST['nama'];
        $harga=$_POST['harga'];
        $harga=str_replace(".","",$harga);
        $status=$_POST['status'];
        if(isset($_POST['ganti_gambar'])){ 
            $gambarnama=$_FILES['gambar']['name'];
            $tmpgambar=$_FILES['gambar']['tmp_name'];
            $gambar=date('YmdHis').$gambarnama;
            $tujuan='../gambar/menu/'.$gambar;
            if(move_uploaded_file($tmpgambar, $tujuan)){ 
                if(is_file("../gambar/menu/".$data[5])) unlink("../gambar/menu/".$data[5]);
                $ubah = mysqli_query($conn,"UPDATE t_menu set jenis_menu='$jenis',nama_menu='$nama',harga='$harga',status_menu='$status', thumb='$gambar' where id_menu='$id'");
                if($ubah){ 
                    ?>
                    <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Selamat!</strong> Data Berhasil Diubah.
                    </div>
                    <script>setTimeout('location.replace("?page=menu")', 2250);</script>
                    <?php 
                }else{
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Maaf!</strong> Data Gagal Diubah.
                    </div> 
                    <script>setTimeout('location.replace("?page=menu")', 2250);</script>
                    <?php 
                }
            }else{
                ?>
                <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Maaf!</strong> Upload Gagal.
                </div>
                <script>setTimeout('location.replace("?page=menu")', 2250);</script>      
                <?php 
            }
        }else{
            $ubah = mysqli_query($conn, "UPDATE t_menu set jenis_menu='$jenis',nama_menu='$nama',harga='$harga',status_menu='$status' where id_menu='$id]'");
            if($ubah){ 
                ?>
                <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Selamat!</strong> Data Berhasil Diubah.
                </div>
                <script>setTimeout('location.replace("?page=menu")', 2250);</script>       
                <?php 
            }else{
                ?>
                <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Maaf!</strong> Data Gagal Diubah.
                </div>
                <script>setTimeout('location.replace("?page=menu")', 2250);</script>    
                <?php 
            }
        }
    }
    ?>
    <form name="edit" method="post" class="form" enctype="multipart/form-data">
        <div class="card animated fadeIn">
            <div class="card-header">
                <h6 class="card-title">Edit Data</h6>
            </div>
            <div class="card-body">
                <select required name="jenis" class="w3-input">
                    <option value="<?php echo $data[1]?>"><?php echo $data[1]?></option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                </select>
                <div class="batas"></div>
                <input type="text" name="nama" class="w3-input" placeholder="Nama Menu" value="<?php echo $data[2]?>" required>
                <div class="batas"></div>
                <input type="number" name="harga" min="1" class="w3-input uang" placeholder="Harga Menu" value="<?php echo $data[3]?>" required>
                <div class="batas"></div>
                <input type="text" name="status" class="w3-input" placeholder="Status Menu" value="<?php echo $data[4]?>" required>
                <div class="batas"></div>
                Ceklis jika ingin mengubah gambar
                <div class="batas"></div>
                <div class="row">
                    <div class="col-1"><input type="checkbox" name="ganti_gambar" value="true" class="w3-check" onchange="document.getElementById('gambar').disabled=!this.checked;" style="vertical-align:middle;"></div>
                    <div class="col-11"><input type="file" name="gambar" class="w3-input" disabled id="gambar"></div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="edit" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Update
                </button>
                <a href="?page=menu" class="btn btn-sm btn-danger">
                    <i class="fa fa-close" aria-hidden="true"></i>&nbsp;Batal
                </a>
            </div>
        </div>
    </form>
    <?php
}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    $cari= mysqli_query($conn,"SELECT * FROM t_menu WHERE id_menu='$id'");
    $data = mysqli_fetch_array($cari);
    $gambar=$data[5];
    $hapus=mysqli_query($conn,"DELETE from t_menu where id_menu='$id'");
    if($hapus){
        if(is_file("../gambar/menu/".$gambar)) unlink("../gambar/menu/".$gambar); 
        ?>
        <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Sukses</strong> Hapus Data Berhasil.
        </div>
        <script>setTimeout('location.replace("?page=menu")', 2250);</script>
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
        <script>setTimeout('location.replace("?page=menu")', 2250);</script>
        <?php
    }
}
?>

<div class="batas"></div>
<div class="table-responsive animated fadeIn">
    <table class="table table-hover">
        <thead class="thead-inverse">
            <tr>
                <th>No</th>
                <th>Jenis Menu</th>
                <th>Nama Menu</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Gambar</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $t_menu=mysqli_query($conn,"select * from t_menu order by jenis_menu");
        $no=1;
        while($dt=mysqli_fetch_array($t_menu)){
            ?>
            <tr>
                <td><?php echo $no++;?></td>
                <td><?php echo $dt[1];?></td>
                <td><?php echo $dt[2];?></td>
                <td class="uang"><?php echo $dt[3];?></td>
                <td><?php echo $dt[4];?></td>
                <td>
                    <img src="../gambar/menu/<?php echo $dt[5];?>" alt="<?php echo $dt[2];?>" class="img-thumbnail thumb" style="height:100px;width:100px">
                </td>
                <td>
                    <a href="?page=menu&edit=<?php echo $dt[0];?>" title="Edit Data"><i class="fa fa-edit w3-text-blue" aria-hidden="true"></i></a>&nbsp;
                    <a href="?page=menu&hapus=<?php echo $dt[0];?>" title="Hapus Data" onclick="return confirm('Apakah Anda Ingin Menghapus Data ini..?')"><i class="fa fa-trash w3-text-red" aria-hidden="true"></i></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script src="../assets/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $(".uang").mask('000.000.000.000', {reverse:true});

        $(".thumb").click(function(){
            var src = $(this).attr("src");
            $("#zoom").attr("src",src);
            $("#modalimg").css("display","block")
        });
    });  
</script>