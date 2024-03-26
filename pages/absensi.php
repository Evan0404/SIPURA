<?php 
    $vendor = "
        <link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'></script>  
        <script src='tmplt/js/demo/datatables-demo.js'></script>
        <link rel='stylesheet' href='https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css' />
  
        <script src='https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js'></script>
        <script>
            $(document).ready(function() {
                $('#js-example-basic-single').select2();
            });
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>
    
    ";
?>


<div class="col-md-4">
    <div class="card p-2 mb-3 w-100">
        <h5>Form Absensi TPS <?= $tps?></h5>
        <form method="POST">
            <label>No/NIK/Nama</label>
            <select name="warga_id" class="form-control mb-2" id="js-example-basic-single">
                <?php
                    $nomor = 1;
                    $getWarga = $con->query("SELECT * FROM wargas WHERE tps = '$tps' ORDER BY nama_warga ASC");
                    foreach($getWarga as $data){
                ?> 
                    <?php
                        $getAbsen = $con->query("SELECT COUNT(*) as jumlah FROM absens WHERE warga_id = '$data[id_warga]'")->fetch_assoc();
                        if($getAbsen['jumlah'] == 0){
                    ?>
                        <option value="<?= $data["id_warga"]?>"><?= $data["no_urut"]?> | <?= $data["nama_warga"]?> | <?= $data["nik"]?></option>
                    <?php }?>
                <?php }?>
            </select>
            <br><br>
            <button name="datang" class="btn btn-primary w-100">Datang</button>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['datang'])){
        $con->query("INSERT INTO `absens`(`warga_id`, `tps`, `kpps`) VALUES ('$_POST[warga_id]','$tps','$kpps')");
        echo"
            <script>
                alert('Warga Datang');
                document.location.href='index.php?hal=absensi';
            </script>
        ";
    }
    
    if(isset($_GET['del'])){
        $con->query("DELETE FROM absens WHERE id_absen = '$_GET[del]'");
        echo"
            <script>
                alert('Menghapus Warga Datang');
                document.location.href='index.php?hal=absensi';
            </script>
        ";
    }
?>

<di class="col-md-8">
    <div class="card p-2 w-100">
        <h5>Absensi Datang TPS <?= $tps?></h5>
        <?php
            $datang = $con->query("SELECT COUNT(*) as jumlahDatang FROM absens WHERE tps = '$tps' ")->fetch_assoc();
            $JumWar = $con->query("SELECT COUNT(*) as jumlahWarga FROM wargas WHERE tps = '$tps' ")->fetch_assoc();
        ?>
        <div class="row">
            <div class="col-md-5">
                <div style="border-radius: 10px;" class="bg-success mb-2 w-100 p-1 text-light">
                    <center>
                        <div class="row">
                            <div class="col-4">
                                <h1 style="color: white;"><i class="bi bi-person-check"></i></h1>
                            </div>
                            <div class="col-8">
                                <h3 style="color: white;" class="mb-0 mt-2"><b><?= $datang['jumlahDatang']?> Jiwa</b></h3>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
            <div class="col-md-5">
                <div style="border-radius: 10px;" class="bg-danger mb-2 w-100 p-1 text-light">
                    <center>
                        <div class="row">
                            <div class="col-4">
                                <h1 style="color: white;"><i class="bi bi-person-dash"></i></h1>
                            </div>
                            <div class="col-8">
                                <h3 style="color: white;" class="mb-0 mt-2"><b><?= $JumWar['jumlahWarga']-$datang['jumlahDatang']?> Jiwa</b></h3>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table class="table" id="myTable"  width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No Urut</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Datang Pada</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $getWarga=$con->query("SELECT *, absens.created_at as datang FROM absens INNER JOIN wargas ON wargas.id_warga = absens.warga_id WHERE absens.tps = '$tps' ORDER BY no_urut ASC");
                        foreach($getWarga as $warga){
                    ?>
                        <tr>
                            <td><?= $warga['no_urut']?></td>
                            <td><?= $warga['nama_warga']?></td>
                            <td><?= $warga['status']?></td>
                            <td><?= $warga['datang']?></td>
                            <td>
                                <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')" href="index.php?hal=absensi&del=<?= $warga['id_absen']?>" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</di>