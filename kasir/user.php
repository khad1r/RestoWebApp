<div class="card">

    <div class="card-header">
        <a class="btn btn-danger" href="?page=home" role="button">
            Kembali
        </a>
    </div>

    <div class="card-body">

        <?php
        if(!isset($_GET['edit'])){
            ?>
            <button class="btn btn-sm w3-teal" onclick="document.getElementById('tambah').style.display='block';">
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
            if(isset($_POST['tambah'])){
                $username=$_POST['username'];
                $pass=$_POST['password'];
                $nama=$_POST['nama'];
                $level=$_POST['level'];
                
                $Cekuser=mysqli_query($conn,"select * From t_user where username='$username'");
                $user=mysqli_fetch_array($Cekuser);
                if($user==null){
                    $simpan=mysqli_query($conn,"insert into t_user values('','$username','$pass','$nama','2')");
                    if($simpan){
                        ?>
                        <div class="alert alert-success alert-dismissible fade show animated zoomInDown" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Sukses</strong> Tambah Data Berhasil.
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
                            <strong>Gagal</strong> Tambah Data Gagal.
                        </div>
                        <script>setTimeout('location.replace("?page=user")', 1750);</script>
                        <?php
                    }
                }else{
                    ?>
                    <div class="alert alert-danger alert-dismissible fade show animated zoomInDown" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <strong>Gagal</strong> Username tidak boleh sama.
                    </div>
                    <script>setTimeout('location.replace("?page=user")', 1750);</script>
                    <?php
                }
            }
        }

        if(isset($_GET['edit'])){
            $id=$_GET['edit'];
            $cari=mysqli_query($conn,"select * from t_user where id_user='$id'");
            $data=mysqli_fetch_array($cari);
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
            ?>
            <form name="edit" method="post">
                <div class="card">
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

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="small">
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama User</th>
                        <th>Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="small">
                    <tr>
                    <?php
                    $tabel=mysqli_query($conn,"SELECT * From t_user WHERE id_level in (1,2)");
                    $no=1;
                    while($dtable=mysqli_fetch_array($tabel)){
                        $akses=mysqli_query($conn,"select * From t_level where id_level='$dtable[4]'");
                        $dtakses=mysqli_fetch_array($akses);
                        ?>
                        <tr>
                            <td><?php echo $no++ ;?></td>
                            <td><?php echo $dtable[1];?></td>
                            <td><?php echo $dtable[2];?></td>
                            <td><?php echo $dtable[3];?></td>
                            <td><?php echo $dtakses[1];?></td>
                            <td>
                                <a href="?page=user&edit=<?php echo $dtable[0];?>" title="Edit Data">
                                    <i class="fa fa-edit w3-text-green" aria-hidden="true"></i>
                                </a>&nbsp;
                                <a href="?page=user&hapus=<?php echo $dtable[0];?>" title="Hapus Data" onclick="return confirm('Ingin Menghapus User <?php echo $dtable[3];?>...?')">
                                    <i class="fa fa-trash w3-text-red" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</div>