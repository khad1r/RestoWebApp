<nav class="breadcrumb">
    <a class="breadcrumb-item" href="?page=home"><i class="fa fa-home" aria-hidden="true"></i> Beranda</a>
    <span class="breadcrumb-item active">Registrasi</span>
</nav>


<?php
if(!isset($_GET['edit'])){
    ?>
    <button type="button" class="btn btn-success btn-sm animated fadeIn" onclick="document.getElementById('tambah').style.display='block';">
        <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
    </button>
    <div class="batas"></div>
    <form name="tambah" method="post">
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
                        <input type="text" name="username" class="w3-input" placeholder="Username" required>
                        <div class="batas"></div>
                        <input type="text" name="password" class="w3-input" placeholder="Password" required>
                        <div class="batas"></div>
                        <input type="text" name="nama" class="w3-input" placeholder="Nama" required>
                        <div class="batas"></div>
                        <select required name="level" class="w3-input">
                            <Option disabled selected>Level User</Option>
                            <?php
                            $opsi=mysqli_query($conn,"select * from t_level");
                            while($dt=mysqli_fetch_array($opsi)){
                                ?>
                                <option value="<?php echo $dt[0]?>">
                                <?php echo $dt[0]." | ".$dt[1]?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
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
    $username=$_POST['username'];
    $password=$_POST['password'];
    $name=$_POST['nama'];
    $level=$_POST['level'];
    $insert=mysqli_query($conn,"INSERT into t_user Values('','$username','$password','$name','$level')");
    if($insert){
        ?>
        <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Berhasil</strong> Data Berhasil Ditambahkan.
        </div>
        <script>setTimeout('location.replace("?page=user")', 2000);</script>
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
        <script>setTimeout('location.replace("?page=user")', 2000);</script>
        <?php
    }
}

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $cari=mysqli_query($conn,"select * from t_user where id_user='$id'");
    $data=mysqli_fetch_array($cari);
    ?>
    <form name="edit" method="post">
        <div class="card animated fadeIn">
            <div class="card-header">
                <h6 class="card-title">Edit Data</h6>
            </div>
            <div class="card-body">
                <label>Username</label>
                <input type="text" name="username" class="w3-input" placeholder="Username" value="<?php echo $data[1]?>" required>
                <div class="batas"></div>
                <label>Password</label>
                <input type="text" name="password" class="w3-input" placeholder="Password" value="<?php echo $data[2]?>" required>
                <div class="batas"></div>
                <label>Nama</label>
                <input type="text" name="nama" class="w3-input" placeholder="Nama" value="<?php echo $data[3]?>" required>
                <div class="batas"></div>
                <select required name="level" class="w3-input">
                    <Option value="<?php echo $data[4]?>"><?php echo $data[4]?></Option>
                    <?php
                    $opsi=mysqli_query($conn,"select * from t_level");
                    while($dt=mysqli_fetch_array($opsi)){
                        ?>
                        <option value="<?php echo $dt[0]?>">
                        <?php echo $dt[0]." | ".$dt[1]?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="card-footer">
                <button type="submit" name="edit" class="btn btn-sm btn-primary">
                    <i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Update
                </button>
                <a href="?page=user" class="btn btn-sm btn-danger">
                    <i class="fa fa-close" aria-hidden="true"></i>&nbsp;Batal
                </a>
            </div>
        </div>
    </form>
    
    <?php
    if(isset($_POST['edit'])){
        $username=$_POST['username'];
        $pass=$_POST['password'];
        $nama=$_POST['nama'];
        if($_POST['level']=null){
            $level=$_POST['level'];
        }else{
            $level=$data[4];
        }
        $simpan=mysqli_query($conn,"update t_user set username='$username', password='$pass', nama_user='$nama', id_level='$level' where id_user='$id'");
        if($simpan){
            ?>
            <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Sukses</strong> Update Data Berhasil.
            </div>
            <script>setTimeout('location.replace("?page=user")', 1750);</script>
            <?php
        }else{
            ?>
            <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>Gagal</strong> Update Data Gagal.
            </div>
            <script>setTimeout('location.replace("?page=user")', 1750);</script>
            <?php
        }
    }
}

if(isset($_GET['hapus'])){
    $id=$_GET['hapus'];
    $hapus=mysqli_query($conn,"delete from t_user where id_user='$id'");
    if($hapus){
        ?>
        <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Sukses</strong> Hapus Data Berhasil.
        </div>
        <script>setTimeout('location.replace("?page=user")', 1750);</script>
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
        <script>setTimeout('location.replace("?page=user")', 3000);</script>
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
                <th>Username</th>
                <th>Password</th>
                <th>Nama</th>
                <th>Level</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $t_user=mysqli_query($conn,"select * from t_user order by id_user desc");
        $no=1;
        while($dt=mysqli_fetch_array($t_user)){
            $_level=mysqli_query($conn,"select * from t_level where id_level='$dt[4]'");
            $d=mysqli_fetch_array($_level)
            ?>
            <tr>
                <td><?php echo $no++;?></td>
                <td><?php echo $dt[1];?></td>
                <td><?php echo $dt[2];?></td>
                <td><?php echo $dt[3];?></td>
                <td><?php echo $d[1];?></td>
                <td>
                    <a href="?page=user&edit=<?php echo $dt[0];?>" title="Edit Data">
                        <i class="fa fa-edit w3-text-blue" aria-hidden="true"></i>
                    </a>&nbsp;
                    <a href="?page=user&hapus=<?php echo $dt[0];?>" title="Hapus Data" onclick="return confirm('Ingin Menghapus User <?php echo $dtable[3];?>...?')">
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