<div class="col-md-12">
    <div class="card shadow p-2 w-100 mb-2">
        <h5>Buat Catatan TPS <?= $tps?> | KPPS <?= $kpps?></h5>
        <form method="POST">
            <label>Catatan</label>
            <?php
                $cekCatatan=$con->query("SELECT *, COUNT(*) as jumlah FROM catatans WHERE tps = '$tps' and kpps = '$kpps'")->fetch_assoc();
            ?>
            <?php if($cekCatatan['jumlah'] == 0){?>
                <textarea name="keterangan" id="editor" class="w-100 form-control">
    
                </textarea>
                <br>
                <button name="save" class="btn btn-primary w-100">Save</button>
            <?php }else{?>
                <textarea name="keterangan" id="editor" class="w-100 form-control">
                    <?= $cekCatatan['keterangan']?>
                </textarea>
                <br>
                <button name="update" class="btn btn-primary w-100">Save</button>
            <?php }?>
        </form>
    </div>
    <br>
    <?php if($kpps == '01'){?>
        <div class="row">
            <?php
                $getCatatanKPPS = $con->query("SELECT * FROM catatans WHERE tps='$tps' AND kpps != '$kpps'");
                foreach($getCatatanKPPS as $cttn){
            ?>
                <div class="col-md-4">
                    <div class="card p-2 w-100">
                        <h5>Catatan TPS <?= $tps?> KPPS <?= $cttn['kpps']?></h5>
                        <?= $cttn['keterangan']?>
                    </div>
                </div>
            <?php }?>
        </div>
    <?php }elseif($kpps == 'PPS'){?>
        <div class="row">
            <?php
                $getCatatanKPPS = $con->query("SELECT * FROM catatans WHERE kpps != '$kpps'");
                foreach($getCatatanKPPS as $cttn){
            ?>
                    <div class="col-md-4">
                        <div class="card p-2 w-100">
                            <h5>Catatan TPS <?= $tps?> KPPS <?= $cttn['kpps']?></h5>
                            <?= $cttn['keterangan']?>
                        </div>
                    </div>
                
            <?php }?>
        </div>
    <?php }?>
</div>

<?php
    if(isset($_POST['save'])){
        $con->query("INSERT INTO catatans (`keterangan`, `kpps`, `tps`) VALUES ('$_POST[keterangan]', '$kpps', '$tps')");
        echo"
            <script>
                alert('Memperbarui Catatan');
                document.location.href='index.php?hal=catatan';
            </script>
        ";
    }
    if(isset($_POST['update'])){
        $con->query("UPDATE catatans SET keterangan = '$_POST[keterangan]' WHERE tps='$tps' and kpps = '$kpps'");
        echo"
            <script>
                alert('Memperbarui Catatan');
                document.location.href='index.php?hal=catatan';
            </script>
        ";
    }
?>


<?php 
    $vendor = "
        <script src='https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js'></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>
    
    ";
?>