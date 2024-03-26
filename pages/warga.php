<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-primary w-25" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Tambah
</button>

<!-- Modal ADD -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Warga TPS <?= $tps?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
            <div class="row">
                <div class="col-md-6">
                    <label>NIK</label>
                    <input type="text" class="form-control mb-2" name="nik">
                </div>
                <div class="col-md-6">
                    <label>Nama</label>
                    <input type="text" class="form-control mb-2" name="nama_warga">
                </div>
                <div class="col-md-3">
                    <label>RT</label>
                    <input type="text" class="form-control mb-2" name="rt">
                </div>
                <div class="col-md-3">
                    <label>RW</label>
                    <input type="text" class="form-control mb-2" name="rw">
                </div>
                <div class="col-md-3">
                    <label>TPS</label>
                    <input type="text" class="form-control mb-2" name="tps" value="<?= $tps?>">
                </div>
                <div class="col-md-3">
                    <label>No. Urut</label>
                    <input type="text" class="form-control mb-2" name="no_urut" >
                </div>
                <div class="col-md-6">
                    <label>Status</label>
                    <select name="status" class="form-control mb-2">
                        <option value="DPT">DPT</option>
                        <option value="DPTb">DPTb</option>
                        <option value="DPK">DPK</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Jumlah Surat Suara</label>
                    <input type="number" class="form-control mb-2" name="surat_suara" value="5">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button name="save" type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    if(isset($_POST['save'])){
        $con->query("INSERT INTO `wargas`(`nik`, `nama_warga`, `no_urut`, `rt`, `rw`, `status`, `tps`, `surat_suara`) VALUES ('$_POST[nik]','$_POST[nama_warga]','$_POST[no_urut]','$_POST[rt]','$_POST[rw]','$_POST[status]','$_POST[tps]','$_POST[surat_suara]')");

        echo"
            <script>
                alert('Warga Bershasil Ditambah');
                document.location.href='index.php?hal=warga';
            </script>
        ";
    }

    if(isset($_GET['del'])){
        $con->query("DELETE FROM wargas WHERE id_warga = '$_GET[del]'");

        echo"
            <script>
                alert('Warga Bershasil Dihapus');
                document.location.href='index.php?hal=warga';
            </script>
        ";
    }

    if(isset($_POST['edit'])){
        $con->query("UPDATE `wargas` SET `nik`='$_POST[nik]',`nama_warga`='$_POST[nama_warga]',`no_urut`='$_POST[no_urut]',`rt`='$_POST[rt]',`rw`='$_POST[rw]',`status`='$_POST[status]',`tps`='$_POST[tps]',`surat_suara`='$_POST[surat_suara]' WHERE id_warga = '$_POST[id_warga]'");
        echo"
            <script>
                alert('Warga Bershasil DiEdit');
                document.location.href='index.php?hal=warga';
            </script>
        ";
    }
?>

<div class="card shadow mt-2 p-2 w-100">
    <h5>Daftar Warga TPS <?= $tps?></h5>
    <div class="table-responsive">
        <table class="table" id="dataTable"  width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>TPS</th>
                    <th>Alamat</th>
                    <th>Status/Suara</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($tps=='PPS'){
                        $getWarga=$con->query("SELECT * FROM wargas ORDER BY no_urut ASC");
                    }else{
                        $getWarga=$con->query("SELECT * FROM wargas WHERE tps = '$tps' ORDER BY no_urut ASC");
                    }
                    foreach($getWarga as $warga){
                ?>
                    <tr>
                        <td><?= $warga['no_urut']?></td>
                        <td><?= $warga['nama_warga']?></td>
                        <td><?= $warga['nik']?></td>
                        <td><?= $warga['tps']?></td>
                        <td>RT. <?= $warga['rt']?> / RW. <?= $warga['rw']?></td>
                        <td><?= $warga['status']?> / <?= $warga['surat_suara']?> Suara</td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropE<?= $warga['id_warga']?>">
                              Edit
                            </button>
                            <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')" href="index.php?hal=warga&del=<?= $warga['id_warga']?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    <!-- Modal ADD -->
                    <div class="modal fade" id="staticBackdropE<?= $warga['id_warga']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit Warga <?= $warga['nama_warga']?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>NIK</label>
                                        <input type="text" class="form-control mb-2" value="<?= $warga['nik']?>" name="nik">
                                        <input type="text" hidden class="form-control mb-2" value="<?= $warga['id_warga']?>" name="id_warga">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nama</label>
                                        <input type="text" class="form-control mb-2" value="<?= $warga['nama_warga']?>" name="nama_warga">
                                    </div>
                                    <div class="col-md-3">
                                        <label>RT</label>
                                        <input type="text" class="form-control mb-2" value="<?= $warga['rt']?>" name="rt">
                                    </div>
                                    <div class="col-md-3">
                                        <label>RW</label>
                                        <input type="text" class="form-control mb-2" value="<?= $warga['rw']?>" name="rw">
                                    </div>
                                    <div class="col-md-3">
                                        <label>TPS</label>
                                        <input type="text" class="form-control mb-2" value="<?= $warga['tps']?>" name="tps">
                                    </div>
                                    <div class="col-md-3">
                                        <label>No. Urut</label>
                                        <input type="text" class="form-control mb-2" value="<?= $warga['no_urut']?>" name="no_urut" >
                                    </div>
                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control mb-2">
                                            <option value="<?= $warga['status']?>"><?= $warga['status']?></option>
                                            <option value="DPT">DPT</option>
                                            <option value="DPTb">DPTb</option>
                                            <option value="DPK">DPK</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Jumlah Surat Suara</label>
                                        <input type="number" class="form-control mb-2" name="surat_suara" value="<?= $warga['surat_suara']?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button name="edit" type="submit" class="btn btn-success">Edit</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>

<?php 
    $vendor = "
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css' />
    <script src='https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js'></script>
        <script>
            $(document).ready( function () {
                $('#dataTable').DataTable();
            } );
        </script>
    ";
?>