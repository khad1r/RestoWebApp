<?php
$id=$akun[0];
$cari=mysqli_query($conn,"select * from t_user where id_user='$id'");
$data=mysqli_fetch_array($cari);
?>


<nav class="breadcrumb">
    <a class="breadcrumb-item" href="?page=home"><i class="fa fa-home" aria-hidden="true"></i> Beranda</a>
    <span class="breadcrumb-item active">Pengaturan</span>
</nav>

<form name="edit" method="post">
    <div class="card animated fadeIn">
        <div class="card-header">
            <h6 class="card-title">Edit Data</h6>
        </div>
        <div class="card-body">
            <label for>Username</label>
            <input type="text" name="username" class="w3-input" placeholder="Username" value="<?php echo $data[1]?>" required>
            <div class="batas"></div>
            <label>Password</label>
            <input type="text" name="password" class="w3-input" placeholder="Password" value="<?php echo $data[2]?>" required>
            <div class="batas"></div>
            <label>Nama</label>
            <input type="text" name="nama" class="w3-input" placeholder="Nama" value="<?php echo $data[3]?>" required>
            <div class="batas"></div>
        </div>
        <div class="card-footer">
            <button type="submit" name="edit" class="btn btn-sm btn-primary">
                <i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Simpan
            </button>
            <a href="?page=home" class="btn btn-sm btn-secondary">Batal
            </a>
        </div>
    </div>
</form>

<?php
if(isset($_POST['edit'])){
    $username=$_POST['username'];
    $pass=$_POST['password'];
    $nama=$_POST['nama'];
    $simpan=mysqli_query($conn,"update t_user set username='$username', password='$pass', nama_user='$nama' where id_user='$id'");
    if($simpan){
        ?>
        <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>Sukses</strong> Update Data Berhasil.
        </div>
        <script>setTimeout('location.replace("?page=home")', 1750);</script>
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
        <script>setTimeout('location.replace("?page=home")', 1750);</script>
        <?php
    }
}
?>