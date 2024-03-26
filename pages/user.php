<!-- Button trigger modal -->
<button type="button" class="btn btn-primary w-25 btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Tambah
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="row">
              <div class="col-md-6">
                  <label>TPS</label>
                  <input type="text" class="form-control mb-2" name="tps" required>
              </div>
              <div class="col-md-6">
                  <label>KPPS</label>
                  <input type="text" class="form-control mb-2" name="kpps"required">
              </div>
              <div class="col-md-6">
                  <label>Nama</label>
                  <input type="text" class="form-control mb-2" name="nama_user" placeholder="Jika Kosong, isi dengan '-'">
              </div>
              <div class="col-md-6">
                  <label>NIK</label>
                  <input type="text" class="form-control mb-2" name="nik" placeholder="Jika Kosong, isi dengan '-'">
              </div>
              <div class="col-md-12">
                  <label>Email</label>
                  <input type="text" class="form-control mb-2" name="email" placeholder="Jika Kosong, isi dengan '-'">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
  if(isset($_POST['save'])){
    $con->query("INSERT INTO user (nama_user, tps, kpps, nik, email) VALUES ('$_POST[nama_user]', '$_POST[tps]', '$_POST[kpps]', '$_POST[nik]', '$_POST[email]')");
    echo "
      <script>
        alert('Berhasil Menambah');
        document.location.href='index.php?hal=User';
      </script>
    ";
  }
  
  if(isset($_GET['del'])){
    $con->query("DELETE FROM user WHERE id_user = '$_GET[del]'");
    echo "
      <script>
        alert('Berhasil Menghapus');
        document.location.href='index.php?hal=User';
      </script>
    ";
  }
?>
<div class="table-responsive">
  <table class="table">
      <thead>
          <tr>
              <th>TPS</th>
              <th>KPPS</th>
              <th>Nama</th>
              <th>NIK</th>
              <th>Email</th>
              <th>Aksi</th>
          </tr>
      </thead>
      <tbody>
          <?php
              $getUser = $con->query("SELECT * FROM user ORDER BY tps ASC");
              foreach($getUser as $user){
          ?>
              <tr>
                  <td><?= $user['tps']?></td>
                  <td><?= $user['kpps']?></td>
                  <td><?= $user['nama_user']?></td>
                  <td><?= $user['nik']?></td>
                  <td><?= $user['email']?></td>
                  <td>
                      <a href="index.php?hal=User&del=<?= $user['id_user']?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                  </td>
              </tr>
          <?php }?>
      </tbody>
  </table>
</div>