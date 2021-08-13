<nav class="breadcrumb">
    <a class="breadcrumb-item" href="?page=home"><i class="fa fa-home" aria-hidden="true"></i> Beranda</a>
    <span class="breadcrumb-item active">Laporan</span>
</nav>
<html>

<head>
    <link rel="stylesheet" href="../assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/DataTables/Buttons-1.5.4/css/buttons.bootstrap4.min.css">
</head>

<body>
    <div class="table-responsive container animated fadeIn">
        <table id="example" class="table table-hover table-bordered">
            <?php 
                if($_GET['apa']=='user'){
                    ?>
                    <thead class="small">
                        <th>No.</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Nama User</th>
                    </thead>
                    <tbody>
                        <?php
                    $no=1;
                    $list=  mysqli_query($conn, "select * from t_user");
                    while ($listview=  mysqli_fetch_array($list)){
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++;?>
                            </td>
                            <td>
                                <?php echo $listview[1];?>
                            </td>
                            <td>
                                <?php echo $listview[2];?>
                            </td>
                            <td>
                                <?php echo $listview[3];?>
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>
                    </tbody>
                    <?php
                }elseif($_GET['apa']=='menu'){
                    ?>
                    <thead class="small">
                        <th>No.</th>
                        <th>Jenis Menu</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Status Menu</th>
                        <th>Gambar</th>
                    </thead>
                    <tbody>
                        <?php
                    $no=1;
                    $list=  mysqli_query($conn, "select * from t_menu");
                    while ($listview=  mysqli_fetch_array($list)){
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++;?>
                            </td>
                            <td>
                                <?php echo $listview[1];?>
                            </td>
                            <td>
                                <?php echo $listview[2];?>
                            </td>
                            <td class="uang">
                                <?php echo $listview[3];?>
                            </td>
                            <td>
                                <?php echo $listview[4];?>
                            </td>
                            <td>
                                <img src="../gambar/menu/<?php echo $listview[5];?>" alt="<?php echo $listview[2];?>" class="img-thumbnail" style="height:100px;width:100px">
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>
                    </tbody>
                    <?php
                }elseif($_GET['apa']=='order'){
                    ?>
                    <thead class="small">
                        <th>No.</th>
                        <th>No Meja</th>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th>Status Order</th>
                    </thead>
                    <tbody>
                        <?php
                    $no=1;
                    $list=  mysqli_query($conn, "select * from t_order");
                    while ($listview=  mysqli_fetch_array($list)){
                        $a=mysqli_query($conn,"select * From t_user where id_user='$listview[3]'");
                        $d=mysqli_fetch_array($a);
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++;?>
                            </td>
                            <td>
                                <?php echo $listview[1];?>
                            </td>
                            <td>
                                <?php echo $listview[2];?>
                            </td>
                            <td>
                                <?php echo $d[3];?>
                            </td>
                            <td>
                                <?php echo $listview[4];?>
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>
                    </tbody>
                    <?php
                }elseif($_GET['apa']=='transaksi'){
                    ?>
                    <thead class="small">
                        <th>No.</th>
                        <th>User</th>
                        <th>Id Order</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php
                    $no=1;
                    $list=  mysqli_query($conn, "select * from t_transaksi");
                    while ($listview=  mysqli_fetch_array($list)){
                        $a=mysqli_query($conn,"select * From t_user where id_user='$listview[1]'");
                        $d=mysqli_fetch_array($a);
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++;?>
                            </td>
                            <td>
                                <?php echo $d[3];?>
                            </td>
                            <td>
                                <?php echo $listview[2];?>
                            </td>
                            <td>
                                <?php echo $listview[3];?>
                            </td>
                            <td>
                                <?php echo $listview[4];?>
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>
                    </tbody>
                    <?php
                }else{
                    header('location:index.php');
                }
            ?>
        </table>
    </div>



    <script src="../assets/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="../assets/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/DataTables/Buttons-1.5.4/js/dataTables.buttons.min.js"></script>
    <script src="../assets/DataTables/Buttons-1.5.4/js/buttons.bootstrap4.min.js"></script>
    <script src="../assets/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="../assets/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="../assets/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="../assets/DataTables/Buttons-1.5.4/js/buttons.html5.min.js"></script>
    <script src="../assets/DataTables/Buttons-1.5.4/js/buttons.print.min.js"></script>
    <script src="../assets/DataTables/Buttons-1.5.4/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                lengthChange: false,
                responsive: true,
                buttons: ['print','csv', 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        });
    </script>

    
</body>

</html>