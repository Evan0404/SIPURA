<?php 
    if($tps=='PPS'){
        $JumDPT = $con->query("SELECT COUNT(*) as jumlah FROM wargas where status = 'DPT'")->fetch_assoc();
        $JumDPTb = $con->query("SELECT COUNT(*) as jumlah FROM wargas where status = 'DPTb'")->fetch_assoc();
        $JumDatang = $con -> query("SELECT COUNT(*) as jumlah FROM absens")->fetch_assoc();
        $JumSurat = $con->query("SELECT *, COUNT(*) as jum FROM surat_suaras WHERE status='Surat Suara Diterima'")->fetch_assoc();
    }else{
        $JumDPT = $con->query("SELECT COUNT(*) as jumlah FROM wargas where status = 'DPT' and tps = '$tps'")->fetch_assoc();
        $JumDPTb = $con->query("SELECT COUNT(*) as jumlah FROM wargas where status = 'DPTb' and tps = '$tps'")->fetch_assoc();
        $JumDatang = $con -> query("SELECT COUNT(*) as jumlah FROM absens WHERE tps = '$tps'")->fetch_assoc();
        $JumSurat = $con->query("SELECT *, COUNT(*) as jum FROM surat_suaras WHERE tps = '$tps' AND status='Surat Suara Diterima'")->fetch_assoc();
    }
    if($JumSurat['jum'] == 0){
        $surat = 0;
    }else{
        $surat = $JumSurat['jumlah'];
    }
?>
<?php if($tps == 'PPS'){?>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      Pindah User TPS
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pindah User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form method="POST">
                <div class="row">
                    <div class="col-md-12">
                        <select name="tps" class="form-control mb-2" id="">
                            <option hidden>Pilih TPS</option>
                            <option value="PPS">PPS</option>
                            <?php for ($i=1; $i <= 7; $i++) { ?>
                                <option value="00<?=$i?>">00<?=$i?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <select name="kpps" class="form-control mb-2" id="">
                            <option hidden>Pilih KPPS</option>
                            <option value="PPS">PPS</option>
                            <?php for ($i=1; $i <= 7; $i++) { ?>
                                <option value="0<?=$i?>">0<?=$i?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="pindah" class="btn btn-primary">Pindah</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
    <?php 
        if(isset($_POST['pindah'])){
            session_unset();
            $sql = "SELECT * FROM user WHERE tps = '$_POST[tps]' and kpps ='$_POST[kpps]'";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();
            $_SESSION['admin'] = "";
            $_SESSION['admin'] = $row;
            echo  "
                <script>
                    alert('Berhasil Pindah User');
                    document.location.href='index.php?hal=dashboard';
                </script>
            ";
            header("Location: index.php?hal=dashboard");
        }
    ?>
<?php }?>

<div class="col-md-3">
    <div class="card text-light bg-info w-100 p-3">
        <h6  style="color: white;">Jumlah DPT</h6> 
        <center>
            <div class="row">
                <div class="col-3">
                    <h1 style="color: white;"><i class="w-100 bi bi-file-person"></i></h1>
                </div>
                <div class="col-9">
                    <b><h2 style="color: white;"><?= $JumDPT['jumlah']?> Jiwa</h2></b>
                </div>
            </div>
        </center>
    </div>
</div>
<div class="col-md-3">
    <div class="card text-light bg-danger w-100 p-3">
        <h6  style="color: white;">Jumlah DPTb</h6>
        <center>
            <div class="row">
                <div class="col-3">
                    <h1 style="color: white;"><i class="bi bi-person-add"></i></h1>
                </div>
                <div class="col-9">
                    <b><h2 style="color: white;"><?= $JumDPTb['jumlah']?> Jiwa</h2></b>
                </div>
            </div>
        </center>
    </div>
</div>
<div class="col-md-3">
    <div class="card text-light bg-success w-100 p-3">
        <h6  style="color: white;">Jumlah Datang</h6>
        <center>
            <div class="row">
                <div class="col-3">
                    <h1 style="color: white;"><i class="bi bi-person-check"></i></h1>
                </div>
                <div class="col-9">
                    <b><h2 style="color: white;"><?= $JumDatang['jumlah']?> Jiwa</h2></b>
                </div>
            </div>
        </center>
    </div>
</div>
<div class="col-md-3">
    <div class="card text-light bg-warning w-100 p-3">
        <h6  style="color: white;">Surat Suara Datang</h6>
        <center>
            <div class="row">
                <div class="col-3">
                    <h1 style="color: white;"><i class="bi bi-envelope-paper"></i></h1>
                </div>
                <div class="col-9">
                    <b><h3 style="color: white;"><?= $surat?> Surat</h3></b>
                </div>
            </div>
        </center>
    </div>
</div>
<br>
<div class="card p-2">
    <div class="table-responsive">
        <table class="table" id="myTable"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Status/Surat</th>
                    <th>Datang Pada</th>
                    <?php 
                        if($tps=='PPS'){
                            echo"<th>TPS</th>";
                        }else{
                            echo"";
                        }
                    ?>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($tps=='PPS'){
                        $getWarga=$con->query("SELECT *, absens.created_at as datang FROM absens INNER JOIN wargas ON wargas.id_warga = absens.warga_id ORDER BY no_urut ASC");
                    }else{
                        $getWarga=$con->query("SELECT *, absens.created_at as datang FROM absens INNER JOIN wargas ON wargas.id_warga = absens.warga_id WHERE absens.tps = '$tps' ORDER BY no_urut ASC");
                    }
                    foreach($getWarga as $warga){
                ?>
                    <tr>
                        <td><?= $warga['no_urut']?></td>
                        <td><?= $warga['nama_warga']?></td>
                        <td><?= $warga['jenis_kelamin']?></td>
                        <td><?= $warga['status']?>/<?= $warga['surat_suara']?></td>
                        <td><?= $warga['datang']?></td>
                        <?php 
                            if($tps=='PPS'){
                                echo "<td>$warga[tps]</td>";
                            }else{
                            }
                        ?>
                        <!-- <td>
                            <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')" href="index.php?hal=absensi&del=<?= $warga['id_absen']?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td> -->
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="col-md-6">
    <div class="card p-2">
        <h5>Surat Suara</h5>
        <table class="table mb-2">
            <thead>
                <tr>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $getSuara = $con->query("SELECT * FROM surat_suaras WHERE (status = 'Surat Suara Diterima' or status = 'Surat Suara Tidak Sah' or status = 'Surat Suara Sah' or status = 'Surat Suara DPK' or status = 'Surat Suara DPTb') and tps = '$tps'");
                    foreach($getSuara as $SuSu){
                ?>
                    <tr>
                        <td><?= $SuSu['status']?></td>
                        <td><?= $SuSu['jumlah']?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-6">
    <div class="card p-2">
        <h5>Surat Suara Presiden</h5>
        <table class="table mb-2">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $getSuara = $con->query("SELECT * FROM surat_suaras WHERE (status = 'Pres') and tps = '$tps'");
                    foreach($getSuara as $SuSu){
                ?>
                    <tr>
                        <td><?= $SuSu['no']?></td>
                        <td><?= $SuSu['jumlah']?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-6">
    <div class="card p-2">
        <h5>Surat Suara DPR-RI</h5>
        <table class="table mb-2">
            <thead>
                <tr>
                    <th>Partai. Urut</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $getSuara = $con->query("SELECT * FROM surat_suaras WHERE (status = 'DPR-RI') and tps = '$tps'");
                    foreach($getSuara as $SuSu){
                ?>
                    <tr>
                        <td><?= $SuSu['no']?></td>
                        <td><?= $SuSu['jumlah']?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-6">
    <div class="card p-2">
        <h5>Surat Suara DPRD-Provinsi</h5>
        <table class="table mb-2">
            <thead>
                <tr>
                    <th>Partai. Urut</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $getSuara = $con->query("SELECT * FROM surat_suaras WHERE (status = 'DPRD-Prov') and tps = '$tps'");
                    foreach($getSuara as $SuSu){
                ?>
                    <tr>
                        <td><?= $SuSu['no']?></td>
                        <td><?= $SuSu['jumlah']?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-6">
    <div class="card p-2">
        <h5>Surat Suara DPRD-Kabupaten</h5>
        <table class="table mb-2">
            <thead>
                <tr>
                    <th>Partai. Urut</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $getSuara = $con->query("SELECT * FROM surat_suaras WHERE (status = 'DPRD-Kab') and tps = '$tps'");
                    foreach($getSuara as $SuSu){
                ?>
                    <tr>
                        <td><?= $SuSu['no']?></td>
                        <td><?= $SuSu['jumlah']?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-6">
    <div class="card p-2">
        <h5>Surat Suara DPD</h5>
        <table class="table mb-2">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $getSuara = $con->query("SELECT * FROM surat_suaras WHERE (status = 'DPD') and tps = '$tps'");
                    foreach($getSuara as $SuSu){
                ?>
                    <tr>
                        <td><?= $SuSu['no']?></td>
                        <td><?= $SuSu['jumlah']?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>

