<?php if(!isset($_GET['hitung'])){?>
    <?php
        $vendor = "

            <link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' rel='stylesheet' />
            <script src='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'></script>  
            <script>
                $(document).ready(function() {
                    $('#js-example-basic-single').select2();
                    $('#no-sel').select2();
                });

            </script>
        ";
    ?>
    <div class="col-md-6">
        <div class="card shadow p-2 mb-3 w-100">
            <h5>Form Surat Suara</h5>
            <div class="row">
                <div class="col-md-12">
                    <a class="mb-2 btn btn-sm btn-warning w-100" href="index.php?hal=surat-suara&hitung=pres" class="btn btn-sm btn-warning w-100">Pres</a>
                </div>
                <div class="col-md-3">
                    <a class="mb-2 btn btn-sm btn-warning w-100" href="index.php?hal=surat-suara&hitung=dpr-ri" class="btn btn-sm btn-warning w-100">DPR-RI</a>
                </div>
                <div class="col-md-3">
                    <a class="mb-2 btn btn-sm btn-warning w-100" href="index.php?hal=surat-suara&hitung=dpd" class="btn btn-sm btn-warning w-100">DPD</a>
                </div>
                <div class="col-md-3">
                    <a class="mb-2 btn btn-sm btn-warning w-100" href="index.php?hal=surat-suara&hitung=dprd-prov" class="btn btn-sm btn-warning w-100">DPRD-Prv</a>
                </div>
                <div class="col-md-3">
                    <a class="mb-2 btn btn-sm btn-warning w-100" href="index.php?hal=surat-suara&hitung=dprd-kab" class="btn btn-sm btn-warning w-100">DPRD-Kab</a>
                </div>
            </div>
            <form method="POST">
                <label>Jenis Surat Suara</label>
                <select name="status" class="form-control mb-2" id="js-example-basic-single">
                    <option value="Surat Suara Diterima Pres">Surat Suara Diterima Pres</option>
                    <option value="Surat Suara Sah Pres">Surat Suara Sah Pres</option>
                    <option value="Surat Suara Tidak Sah Pres">Surat Suara Tidak Sah Pres</option>
                    <option value="Surat Suara Diterima DPR-RI">Surat Suara Diterima DPR-RI</option>
                    <option value="Surat Suara Sah DPR-RI">Surat Suara Sah DPR-RI</option>
                    <option value="Surat Suara Tidak Sah DPR-RI">Surat Suara Tidak Sah DPR-RI</option>
                    <option value="Surat Suara Diterima DPR-Prov">Surat Suara Diterima DPR-Prov</option>
                    <option value="Surat Suara Sah DPR-Prov">Surat Suara Sah DPR-Prov</option>
                    <option value="Surat Suara Tidak Sah DPR-Prov">Surat Suara Tidak Sah DPR-Prov</option>
                    <option value="Surat Suara Diterima DPR-Kab">Surat Suara Diterima DPR-Kab</option>
                    <option value="Surat Suara Sah DPR-Kab">Surat Suara Sah DPR-Kab</option>
                    <option value="Surat Suara Tidak Sah DPR-Kab">Surat Suara Tidak Sah DPR-Kab</option>
                    <option value="Surat Suara Diterima DPD">Surat Suara Diterima DPD</option>
                    <option value="Surat Suara Sah DPD">Surat Suara Sah DPD</option>
                    <option value="Surat Suara Tidak Sah DPD">Surat Suara Tidak Sah DPD</option>
                </select>
                <label>Jumlah</label>
                <input type="number" class="form-control mb-2" name="jumlah">
                <button class="btn btn-primary w-100" name="simpan">Simpan</button>
            </form>
        </div>
    </div>
    
    <?php
        if(isset($_POST['simpan'])){
            $cekStatus = $con->query("SELECT COUNT(*) as JumDat FROM surat_suaras WHERE tps = '$tps' and status = '$_POST[status]'")->fetch_assoc();
            if($cekStatus['JumDat'] == 0){
                $con->query("INSERT INTO surat_suaras (tps, kpps, jumlah, status) VALUES ('$tps', '$kpps', '$_POST[jumlah]', '$_POST[status]')");
                echo"
                    <script>
                        alert('Data Surat Suara Berhasil DiTambah');
                        document.location.href='index.php?hal=surat-suara';
                    </script>
                ";
            }else{
                echo"
                    <script>
                        alert('Data Surat Suara Sudah Ada, Silahkan Edit Untuk Mengubah');
                        document.location.href='index.php?hal=surat-suara';
                    </script>
                ";
            }
        }
    
        if(isset($_POST['edit'])){
            $cekStatus = $con->query("SELECT COUNT(*) as JumDat FROM surat_suaras WHERE tps = '$tps' and status = '$_POST[status]'")->fetch_assoc();
            if($cekStatus['JumDat'] == 1){
                $con->query("UPDATE surat_suaras SET status = '$_POST[status]', jumlah = '$_POST[jumlah]' WHERE id_surat_suara = '$_POST[id_surat_suara]'");
                echo"
                    <script>
                        alert('Data Surat Suara Berhasil Di Ubah');
                        document.location.href='index.php?hal=surat-suara';
                    </script>
                ";
            }else{
                echo"
                    <script>
                        alert('Jenis Surat Suara Sudah Ada');
                        document.location.href='index.php?hal=surat-suara';
                    </script>
                ";
            }
        }

        if(isset($_GET['del'])){
            $con->query("DELETE FROM surat_suaras WHERE id_surat_suara = '$_GET[del]'");
            echo"
                    <script>
                        alert('Data Surat Suara Berhasil Di Hapus');
                        document.location.href='index.php?hal=surat-suara';
                    </script>
                ";
        }
    ?>


    
    <div class="col-md-6">
        <div class="card shadow p-2 w-100">
            <h5>Suarat Suara TPS <?= $tps?></h5>
            <div class="table-responsive">
                <table class="table" id="dataTable"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $getSurat = $con->query("SELECT * FROM surat_suaras WHERE tps = '$tps' and (status != 'pres' and status != 'dpr-ri' and status != 'dpd' and status != 'dprd-prov' and status != 'dprd-kab')");
                            foreach($getSurat as $surat){
                        ?>
                            <tr>
                                <td><?= $surat['status']?> <?= $surat['no']?></td>
                                <td><?= $surat['jumlah']?> Suara</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $surat['id_surat_suara']?>">
                                      Edit
                                    </button>
                                    <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Surat Suara Ini ?')" href="index.php?hal=surat-suara&del=<?= $surat['id_surat_suara']?>" class="btn btn-sm btn-danger">Hapus</a>    
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="edit<?= $surat['id_surat_suara']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Edit <?= $surat['status']?> TPS <?= $tps?></h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                        <label>Jenis Surat Suara</label>
                                        <form method="POST">
                                            <select name="status" class="form-control mb-2" id="js-example-basic-single">
                                                <option value="<?= $surat['status']?>"><?= $surat['status']?></option>
                                                <option value="Surat Suara Diterima Pres">Surat Suara Diterima Pres</option>
                                                <option value="Surat Suara Sah Pres">Surat Suara Sah Pres</option>
                                                <option value="Surat Suara Tidak Sah Pres">Surat Suara Tidak Sah Pres</option>
                                                <option value="Surat Suara Diterima DPR-RI">Surat Suara Diterima DPR-RI</option>
                                                <option value="Surat Suara Sah DPR-RI">Surat Suara Sah DPR-RI</option>
                                                <option value="Surat Suara Tidak Sah DPR-RI">Surat Suara Tidak Sah DPR-RI</option>
                                                <option value="Surat Suara Diterima DPR-Prov">Surat Suara Diterima DPR-Prov</option>
                                                <option value="Surat Suara Sah DPR-Prov">Surat Suara Sah DPR-Prov</option>
                                                <option value="Surat Suara Tidak Sah DPR-Prov">Surat Suara Tidak Sah DPR-Prov</option>
                                                <option value="Surat Suara Diterima DPR-Kab">Surat Suara Diterima DPR-Kab</option>
                                                <option value="Surat Suara Sah DPR-Kab">Surat Suara Sah DPR-Kab</option>
                                                <option value="Surat Suara Tidak Sah DPR-Kab">Surat Suara Tidak Sah DPR-Kab</option>
                                                <option value="Surat Suara Diterima DPD">Surat Suara Diterima DPD</option>
                                                <option value="Surat Suara Sah DPD">Surat Suara Sah DPD</option>
                                                <option value="Surat Suara Tidak Sah DPD">Surat Suara Tidak Sah DPD</option>
                                            </select>
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control mb-2" name="jumlah" value="<?= $surat['jumlah']?>">
                                            <input hidden type="number" class="form-control mb-2" name="id_surat_suara" value="<?= $surat['id_surat_suara']?>">
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
    </div>
<?php }else{?>
    <?php
        $vendor = "

            <link href='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' rel='stylesheet' />
            <script src='https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'></script>  
            <script>
                $(document).ready(function() {
                    $('#js-example-basic-single').select2();
                    $('#no-sel').select2();
                });

            </script>
        ";
    ?>
    <div class="col-md-5">
        <div class="card shadow p-2 mb-3 w-100">
            <h5>Form Surat Suara</h5>
            <div class="row">
                <div class="col-md-3">
                    <a href="index.php?hal=surat-suara" class="btn btn-sm btn-dark w-100">Kembali</a>
                </div>
            </div>
            <form method="POST">
                <label>No Urut</label>
                <select name="no" class="form-control mb-2" id="no-sel">
                    <option hidden>No Urut</option>
                        <?php if($_GET['hitung'] == 'pres'){?>
                        <?php
                            for ($i=1; $i <= 3; $i++) { 
                        ?>
                            <option value="<?= $i?>"><?= $i?></option>
                        <?php }?>
                    <?php }elseif($_GET['hitung'] == 'dpr-ri'){?>
                        <option hidden>No Urut</option>
                        <?php
                            for ($i=1; $i <= 17; $i++) { 
                        ?>
                            <option value="<?= $i?>"><?= $i?></option>
                            <?php
                                for ($j=1; $j <= 10; $j++) { 
                            ?>
                                <option value="<?= $i?>. <?= $j?>"><?= $i?>. <?= $j?></option>
                            <?php }?>
                        <?php }?>
                        <?php
                            for ($k=1; $k <= 10; $k++) { 
                        ?>
                            <option value="24. <?= $k?>">24. <?= $k?></option>
                        <?php }?>
                    <?php }elseif($_GET['hitung'] == 'dpd'){?>
                        <option hidden>No Urut</option>
                        <?php
                            for ($i=1; $i <= 13; $i++) { 
                        ?>
                            <option value="<?= $i?>"><?= $i?></option>
                        <?php }?>
                    <?php }else{?>
                        <?php
                            for ($i=1; $i <= 17; $i++) { 
                        ?>
                            <option value="<?= $i?>"><?= $i?></option>
                            <?php
                                for ($j=1; $j <= 10; $j++) { 
                            ?>
                                <option value="<?= $i?>. <?= $j?>"><?= $i?>. <?= $j?></option>
                            <?php }?>
                        <?php }?>
                        <?php
                            for ($k=1; $k <= 10; $k++) { 
                        ?>
                            <option value="24. <?= $k?>">24. <?= $k?></option>
                        <?php }?>

                    <?php }?>
                </select>
                <label>Jumlah</label>
                <input type="number" class="form-control mb-2" name="jumlah">
                <button class="btn btn-primary w-100" name="simpan">Simpan</button>
            </form>
        </div>
        <?php 
            if(isset($_POST['simpan'])){
                $cekStatus = $con->query("SELECT COUNT(*) as JumDat FROM surat_suaras WHERE tps = '$tps' and status = '$_GET[hitung]' and no = '$_POST[no]'")->fetch_assoc();
                if($cekStatus['JumDat'] == 0){
                    $con->query("INSERT INTO surat_suaras (tps, kpps, jumlah, status, no) VALUES ('$tps', '$kpps', '$_POST[jumlah]', '$_GET[hitung]', '$_POST[no]')");
                    echo"
                        <script>
                            alert('Data Surat Suara Berhasil DiTambah');
                            document.location.href='index.php?hal=surat-suara&hitung=$_GET[hitung]';
                        </script>
                    ";
                }else{
                    echo"
                        <script>
                            alert('Data Surat Suara Sudah Ada, Silahkan Edit Untuk Mengubah');
                            document.location.href='index.php?hal=surat-suara&hitung=$_GET[hitung]';
                        </script>
                    ";
                }
            }
            if(isset($_POST['edit'])){
                $con->query("UPDATE surat_suaras SET status = '$_POST[status]', jumlah = '$_POST[jumlah]' WHERE id_surat_suara = '$_POST[id_surat_suara]'");
                echo"
                    <script>
                        alert('Data Surat Suara Berhasil Di Ubah');
                        document.location.href='index.php?hal=surat-suara&hitung=$_GET[hitung]';
                    </script>
                ";
            }

            if(isset($_GET['del'])){
                $con->query("DELETE FROM surat_suaras WHERE id_surat_suara = '$_GET[del]'");
                echo"
                    <script>
                        alert('Data Surat Suara Berhasil Di Hapus');
                        document.location.href='index.php?hal=surat-suara&hitung=$_GET[hitung]';
                    </script>
                ";
            }
        ?>
    </div>
    <div class="col-md-7">
    <div class="card shadow p-2 w-100">
            <h5>Suarat Suara TPS <?= $tps?></h5>
            <div class="table-responsive">
                <table class="table" id="dataTable"  width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Jenis</th>
                            <th>No Urut</th>
                            <th>Jumlah</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $getSurat = $con->query("SELECT * FROM surat_suaras WHERE tps = '$tps' and status = '$_GET[hitung]'");
                            foreach($getSurat as $surat){
                        ?>
                            <tr>
                                <td><?= $surat['status']?></td>
                                <td><?= $surat['no']?></td>
                                <td><?= $surat['jumlah']?> Suara</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $surat['id_surat_suara']?>">
                                      Edit
                                    </button>    
                                    <a onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Surat Suara Ini ?')" href="index.php?hal=surat-suara&hitung=<?= $_GET['hitung']?>&del=<?= $surat['id_surat_suara']?>" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="edit<?= $surat['id_surat_suara']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h6 class="modal-title" id="staticBackdropLabel">Edit <?= $surat['status']?> TPS <?= $tps?></h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                        <label>Jenis Surat Suara</label>
                                        <form method="POST">
                                            <select name="status" class="form-control mb-2" id="js-example-basic-single">
                                                <option value="<?= $surat['status']?>"><?= $surat['status']?></option>
                                            </select>
                                            <label>Jumlah</label>
                                            <input type="number" class="form-control mb-2" name="jumlah" value="<?= $surat['jumlah']?>">
                                            <input type="number" class="form-control mb-2" name="no" hidden value="<?= $surat['no']?>">
                                            <input hidden type="number" class="form-control mb-2" name="id_surat_suara" value="<?= $surat['id_surat_suara']?>">
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
    </div>
<?php }?>