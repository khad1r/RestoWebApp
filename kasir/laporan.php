
<link rel="stylesheet" href="../assets/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/DataTables/Buttons-1.5.4/css/buttons.bootstrap4.min.css">

<div class="card">

    <div class="card-header">
        <a class="btn btn-danger" href="?page=home" role="button">
            Kembali
        </a>
    </div>

    <div class="card-body">
    
        <div class="table-responsive container animated fadeIn">
            <table id="example" class="table table-hover table-bordered">
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
            </table>
        </div>

    </div>

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
