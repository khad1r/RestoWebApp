<link rel="stylesheet" href="../assets/select2/css/select2.min.css">


<div id="modalimg" class="w3-modal text-center" onclick="this.style.display='none';" style="pading:50px">
    <div class="w3-modal-content w3-animate-zoom" style="width:500px">
        <img src="" alt="" id="zoom" class="img-thumbnail img-fluid" style="width:100%">
    </div>
</div>

<?php
if(isset($_GET['id'])){
    $id_order=$_GET['id'];
}
?>

<div class="container-fluid kotak" id="order">
    <div class="card">
        <div class="card-header">
            <a class="btn btn-danger" href="?page=home" role="button">
                Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5" style="margin-bottom:20px;">
                    <form name="order" method="post">
                        <div class="card">
                            <div class="card-header">
                                Daftar Orderan
                            </div>
                            <div class="card-body clone-body">
                                <?php
                                if(!isset($_GET['id'])){
                                    ?>
                                    <select required name="meja" class="w3-input pilih" style="width:100%;">
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
                                    <?php
                                }
                                ?>
                                <hr>

                            </div>
                            <?php
                            if(isset($_POST['order'])){
                                $username=$akun[0];
                                $tanggal=date("d-m-Y");
                                if(isset($_GET['id'])){
                                    for($i = 0; $i <= count($_POST['menu'])-1;$i++){
                                        $menu=$_POST['menu'][$i];
                                        $jumlah=$_POST['jumlah'][$i];
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
                                            <script>setTimeout('location.replace("?page=history&id=<?php echo $id_order;?>")', 2000);</script>
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
                                            <script>setTimeout('location.replace("?page=history&id=<?php echo $id_order;?>")', 2000);</script>
                                            <?php
                                        }
                                    }
                                }else{
                                    $meja=$_POST['meja'];
                                    $orderan=mysqli_query($conn,"insert into t_order values('','$meja','$tanggal','$username','Belum Bayar')");
                                    if($orderan){
                                        $order=mysqli_fetch_array(mysqli_query($conn,"SELECT * from t_order where id_order=(SELECT max(id_order) from t_order)"));
                                        $id_order=$order[0];
                                        for($i = 0; $i <= count($_POST['menu'])-1;$i++){
                                            $menu=$_POST['menu'][$i];
                                            $jumlah=$_POST['jumlah'][$i];
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
                                                <script>setTimeout('location.replace("?page=history&id=<?php echo $id_order;?>")', 2000);</script>
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
                                                <script>setTimeout('location.replace("?page=history&id=<?php echo $id_order;?>")', 2000);</script>
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
                                            <strong>Gagal</strong> Order Gagal.
                                        </div>
                                        <script>setTimeout('location.replace("?page=history")', 2500);</script>
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <div class="card-footer">
                                <button type="submit" name="order" class="btn btn-primary pull-right">
                                <i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;Order
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-7">
                    <div class="row menu-body">
                        <?php
                        $menu1=mysqli_query($conn,"SELECT * from t_menu order by jenis_menu");
                        while($makanan=mysqli_fetch_array($menu1)){
                            ?>
                            <div class="col-lg-3 menu" id="<?php echo $makanan[0];?>" style="margin-bottom:12px">
                                <div class="card" style="height:100%;width:100%">
                                    <img class="card-img-top img-thumbnail gmbr" src="../gambar/menu/<?php echo $makanan[5];?>" alt="" style="height:125px;width:100%">
                                    <div class="card-body text-center">
                                        <h6 class="card-title w3-text-blue"><?php echo $makanan[2];?></h6>
                                        <p class="uang w3-text-light-green"><?php echo $makanan[3];?></p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#order" class="btn btn-block btn-primary btnadd" id="<?php echo $makanan[0];?>" nama-menu="<?php echo $makanan[2];?>" harga="<?php echo $makanan[3];?>">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                            Pesan
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="clone" style="display:none;">
    <div class="row">
        <div class="col-1">
            <button type="button" class="btnremove close" onclick="">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="col-4">
            <select name="menu[]" class="w3-input">
                <option value="">pilih</option>
            </select>
        </div>
        <div class="col-2">
            <input type="number" name="jumlah[]" min="1" class="w3-input" id="jumlah">
        </div>
        <div class="col-4">
            <input type="number" class="w3-input harga" id="harga" harga="" readonly>
        </div>
        <div class="col-1"></div>
    <div class="batas"></div>
</div>

<script src="../assets/select2/js/select2.full.min.js"></script>
<script src="../assets/jquery.mask.min.js"></script>
<script src="../assets/relcopy.js"></script>
<script>
    $(document).ready(function () {
        $('.pilih').select2();

        $(".uang").mask("000.000.000.000.000.000", {reverse:true});

        $(".gmbr").click(function(){
            var src = $(this).attr("src");
            $("#zoom").attr("src",src);
            $("#modalimg").css("display","block")
        });

        $('.btnremove').click(function(){
            $(this).parent().parent().parent().slideUp(function(){ $(this).remove() });
            var id = $(this).attr('id');
            var menu = $(".menu-body").find("#"+id);
            menu.slideDown();
            return false
        });

        $(".btnadd").click(function () {
            var master = $("#clone");
            var parent = $(".clone-body");
            var isi = $(this).attr('id');
            var text = $(this).attr('nama-menu');
            var harga = $(this).attr('harga');
                $(this).parents(".menu").slideUp();
                var clone = $(master).clone(true);

                $(clone).attr('id', isi);

                $(clone).attr('class', isi);

                $(clone).css("display","block");
                
                $(clone).find('option').val(isi);
                $(clone).find('#jumlah').val(1);
                $(clone).find('#harga').val(harga);
                $(clone).find('.btnremove').attr('id', isi);
                $(clone).find('#harga').attr('harga', harga);
                $(clone).find('option').text(text);
                $(clone).find('#harga').mask("000,000,000,000,000.000", {reverse:true});

                $(parent).append(clone);
        });

        $("#jumlah").change(function(){
            var parent = $(this).parent().parent();
            $(parent).find("#harga").mask("destroy");
            var harga2 = $(parent).find("#harga").attr('harga');
            var jumlah2 = $(this).val();
            total = harga2 * jumlah2;
            $(parent).find("#harga").val(total);
            $(parent).find("#harga").mask("000,000,000,000,000.000", {reverse:true});
        });

    });
</script>