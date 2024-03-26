<?php 
    session_start();
    include "function.php"
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$AppName?></title>
  <link rel="shortcut icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/thumb/4/46/KPU_Logo.svg/433px-KPU_Logo.svg.png" />
  <!-- <link rel="shortcut icon" type="image/png" href="app/src/assets/images/logos/favicon.png" /> -->
  <link rel="stylesheet" href="app/src/assets/css/styles.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>
  <?php 
   
   $no = 1;
   $getWarga = $con->query("SELECT * FROM wargas WHERE tps = '001' AND (status = 'DPT' or status ='DPK') ORDER BY nama_warga ASC");
   foreach ($getWarga as $data) {
     $con->query("UPDATE wargas SET no_urut = '".$no++."' WHERE id_warga = '$data[id_warga]'");
   }
   $no2 = 1;
   $getWarga2 = $con->query("SELECT * FROM wargas WHERE tps = '002' AND (status = 'DPT' or status ='DPK') ORDER BY nama_warga ASC");
   foreach ($getWarga2 as $data2) {
     $con->query("UPDATE wargas SET no_urut = '".$no2++."' WHERE id_warga = '$data2[id_warga]'");
   }
   $no3 = 1;
   $getWarga3 = $con->query("SELECT * FROM wargas WHERE tps = '003' AND (status = 'DPT' or status ='DPK') ORDER BY nama_warga ASC");
   foreach ($getWarga3 as $data3) {
     $con->query("UPDATE wargas SET no_urut = '".$no3++."' WHERE id_warga = '$data3[id_warga]'");
   }
   $no4 = 1;
   $getWarga4 = $con->query("SELECT * FROM wargas WHERE tps = '004' AND (status = 'DPT' or status ='DPK') ORDER BY nama_warga ASC");
   foreach ($getWarga4 as $data4) {
     $con->query("UPDATE wargas SET no_urut = '".$no4++."' WHERE id_warga = '$data4[id_warga]'");
   }
   $no5 = 1;
   $getWarga5 = $con->query("SELECT * FROM wargas WHERE tps = '005' AND (status = 'DPT' or status ='DPK') ORDER BY nama_warga ASC");
   foreach ($getWarga5 as $data5) {
     $con->query("UPDATE wargas SET no_urut = '".$no5++."' WHERE id_warga = '$data5[id_warga]'");
   }
   $no6 = 1;
   $getWarga6 = $con->query("SELECT * FROM wargas WHERE tps = '006' AND (status = 'DPT' or status ='DPK') ORDER BY nama_warga ASC");
   foreach ($getWarga6 as $data6) {
     $con->query("UPDATE wargas SET no_urut = '".$no6++."' WHERE id_warga = '$data6[id_warga]'");
   }
   $no7 = 1;
   $getWarga7 = $con->query("SELECT * FROM wargas WHERE tps = '007' AND (status = 'DPT' or status ='DPK') ORDER BY nama_warga ASC");
   foreach ($getWarga7 as $data7) {
     $con->query("UPDATE wargas SET no_urut = '".$no7++."' WHERE id_warga = '$data7[id_warga]'");
   }
   $con->query("UPDATE wargas SET no_urut = '-' WHERE status = 'DPTb'");
 
    
  ?>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block my-0 py-3 w-100">
                    <h3 class="text-primary"><i class="bi bi-pin-angle"></i> <b><?= $AppName?></b></h3>
                </a>
                <p class="text-center my-0">Sistem Informasi Pemungutan Suara</p>
                <form method="post">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">TPS</label>
                    <input type="text" class="form-control" name="tps" placeholder="Contoh : 008" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">KPPS</label>
                    <input type="text" class="form-control" name="kpps" placeholder="Contoh : 08" id="exampleInputPassword1">
                  </div>
                  <button type="submit" name="login" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign In</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="app/src/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="app/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php 
    if (isset($_POST['login'])) {
        $tps =$_POST['tps'];
        $kpps =$_POST['kpps'];

        $sql = "SELECT * FROM user WHERE tps = '$tps' and kpps ='$kpps'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['kpps']==$kpps) {
                $_SESSION['admin'] = $row;
                header("Location: index.php?hal=dashboard");
                echo  "Berhasil";
            } else {
                $error = "Invalid kpps";
                echo "
                <script>
                    alert('KPPS Salah');
                    document.location.href='login.php';
                </script>
                ";
            }
        } else {
            $error = "Invalid tps";
            echo "
            <script>
            alert('TPS dan KPPS Salah');
            document.location.href='login.php';
            </script>
        ";
        }
    }
?>