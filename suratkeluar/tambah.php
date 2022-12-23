<?php 
session_start();
if(!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}
require '../functions.php';

$checkS = query("SELECT MAX(s) As 'MAX_Value' FROM suratkeluar");
$checkKep = query("SELECT MAX(kep) As 'MAX_Value' FROM suratkeluar");
$checkSp = query("SELECT MAX(sp) As 'MAX_Value' FROM suratkeluar");
$checkUp = query("SELECT MAX(up) As 'MAX_Value' FROM suratkeluar");
$checkBa = query("SELECT MAX(ba) As 'MAX_Value' FROM suratkeluar");
$checkNd = query("SELECT MAX(nd) As 'MAX_Value' FROM suratkeluar");
$checkPbkm = query("SELECT MAX(pbk_m) As 'MAX_Value' FROM suratkeluar");
$checkVerbal = query("SELECT MAX(verbal) As 'MAX_Value' FROM suratkeluar");
$checkLhpt = query("SELECT MAX(lhpt) As 'MAX_Value' FROM suratkeluar");

date_default_timezone_set('Asia/Jakarta');
if(isset($_POST['tambah'])) {
  if(tambahSuratKeluar($_POST) > 0) {
    echo "
      <script>
        alert('Surat Keluar berhasil ditambahkan');
        document.location.href = 'index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Surat Keluar gagal ditambahkan');
        document.location.href = 'index.php';
      </script>
  ";
  }
}

if(isset($_POST['save'])) {
  $op = $_POST['op'];
  $np = $_POST['np'];
  $cnp = $_POST['c_np'];

  $queryCheck = mysqli_query($conn, "SELECT * FROM users WHERE nip = " . $_SESSION['nip']);
  $result = mysqli_fetch_assoc($queryCheck);

  if(password_verify($op, $result["password"])) {
    if($np == $cnp) {
      $sql = "UPDATE users SET password = '" . password_hash($np, PASSWORD_DEFAULT) . "' WHERE nip = " . $_SESSION['nip'];
      mysqli_query($conn, $sql);
      echo "<script>alert('Passwordmu berhasil diganti')</script>";
    } else {
      echo "<script>alert('Passwordmu tidak sama')</script>";
    }
  } else {
    echo "<script>alert('Passwordmu salah')</script>";
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="../css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="../css/index.css" />

    <title>Tambah Surat Keluar - KPP Pajak</title>
  </head>

  <body>
    <div class="screen-cover d-none d-xl-none"></div>
    <div class="row">
      <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">
        <aside class="sidebar">
          <a href="#" class="sidebar-logo">
            <div class="d-flex justify-content-start align-items-center">
              <img
                src="../assets/img/global/logo.png"
                alt=""
                style="width: 1.5rem"
              />
              <span>KPP Pratama</span>
            </div>

            <button id="toggle-navbar" onclick="toggleNavbar()">
              <img src="../assets/img/global/navbar-times.svg" alt="" />
            </button>
          </a>

          <h5 class="sidebar-title">Sering Digunakan</h5>


          
          <a href="index.php" class="sidebar-item active">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-slash" viewBox="0 0 16 16">
              <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
              <path d="M14.975 10.025a3.5 3.5 0 1 0-4.95 4.95 3.5 3.5 0 0 0 4.95-4.95Zm-4.243.707a2.501 2.501 0 0 1 3.147-.318l-3.465 3.465a2.501 2.501 0 0 1 .318-3.147Zm.39 3.854 3.464-3.465a2.501 2.501 0 0 1-3.465 3.465Z"/>
            </svg>

            <span>Surat Keluar</span>
          </a>

          <a href="../../kpp-pajak/login.php" class="sidebar-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16">
              <path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z"/>
            </svg>

            <span>Lebih Bayar</span>
          </a>

          <h5 class="sidebar-title">Lainnya</h5>

          <a href="../logout.php" class="sidebar-item">
            <!-- <img src="../assets/img/global/log-out.svg" alt=""> -->

            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M16 17L21 12L16 7"
                stroke="#ABB3C4"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 12H9"
                stroke="#ABB3C4"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M9 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H9"
                stroke="#ABB3C4"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>

            <span>Logout</span>
          </a>
        </aside>
      </div>

      <div class="col-12 col-xl-9">
        <div class="nav">
          <div
            class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0"
          >
            <div class="d-flex justify-content-start align-items-center">
              <button id="toggle-navbar" onclick="toggleNavbar()">
                <img src="../assets/img/global/burger.svg" class="mb-2" alt="" />
              </button>
              <h2 class="nav-title">Tambah Surat Keluar</h2>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center nav-input-container">
            <div class="d-flex justify-content-between align-items-center nav-input-container">
              <div class="dropdown">
                <button class="btn-notif d-none d-md-flex flex-nowrap text-capitalize" type="button" id="user-detail" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/img/home/history/photo-1.png" alt="" class="me-2">
                  <?php $getNama = query("SELECT * FROM users WHERE nip = " . $_SESSION["nip"])[0]; echo $getNama["nama"]; ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="user-detail">
                  <li>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#changePwModal">
                      <img src="../assets/img/global/lock.svg" class="me-2">
                      Ganti Password
                    </button>
                  </li>
                  <hr>
                  <li><a class="dropdown-item" href="../logout.php"><img src="../assets/img/global/log-out.svg" alt="logout" class="me-2"> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <div class="content">
          <div class="row">
            <div class="col-12">
              <div class="statistics-card">
                <form action="" method="post">
                  <ul class="list-unstyled d-flex flex-column gap-3">
                    <li>
                      <div class="form-group">
                        <label for="tgl_surat">Tanggal Surat</label>
                        <input type="text" class="form-control" name="tgl_surat" value="<?php $date = date_create("TODAY"); echo date_format($date, "d M Y"); ?>" readonly>
                      </div>
                    </li>
                    <li class="d-flex gap-2">
                      <label for="jenis">Jenis Surat</label>

                      <div class="form-check ms-2">
                        <input class="form-check-input" type="radio" name="up" value="<?php foreach($checkUp as $data) { echo $data["MAX_Value"] + 1 ; } ?>" checked>
                        <label class="form-check-label text-uppercase">
                          up
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="lhpt" value="<?php foreach($checkLhpt as $data) { echo $data["MAX_Value"] + 1 ; } ?>">
                        <label class="form-check-label">
                          LHPt
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="s" value="<?php foreach($checkS as $data) { echo $data["MAX_Value"] + 1 ; } ?>">
                        <label class="form-check-label text-uppercase">
                          s
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="verbal" value="<?php foreach($checkVerbal as $data) { echo $data["MAX_Value"] + 1 ; } ?>">
                        <label class="form-check-label text-uppercase">
                          verbal
                        </label>
                      </div>
                      <span class="px-4">--</span>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="kep" value="<?php foreach($checkKep as $data) { echo $data["MAX_Value"] + 1 ; } ?>">
                        <label class="form-check-label text-uppercase">
                          kep
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="sp" value="<?php foreach($checkSp as $data) { echo $data["MAX_Value"] + 1 ; } ?>">
                        <label class="form-check-label text-uppercase">
                          sp
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="ba" value="<?php foreach($checkBa as $data) { echo $data["MAX_Value"] + 1 ; } ?>">
                        <label class="form-check-label text-uppercase">
                          ba
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="nd" value="<?php foreach($checkNd as $data) { echo $data["MAX_Value"] + 1 ; } ?>">
                        <label class="form-check-label text-uppercase">
                          nd
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="pbk_m" value="<?php foreach($checkPbkm as $data) { echo $data["MAX_Value"] + 1 ; } ?>">
                        <label class="form-check-label text-uppercase">
                          pbkm
                        </label>
                      </div>
                    </li>
                    <li>
                      <label for="keterangan">Keterangan</label>
                      <textarea name="keterangan" rows="10" class="form-control" style="resize:none;"></textarea>
                    </li>
                    <li>
                      <button type="submit" name="tambah" class="btn" style="background-color: #fcc100 !important; color:white;">Submit</button>
                      <a href="index.php" class="btn btn-light ms-2">Kembali</a>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Change PW Modal -->
    <div class="modal fade" id="changePwModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post">
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Password Lama</label>
                <input type="password" class="form-control" name="op">
              </div>
              <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" class="form-control" name="np">
              </div>
              <div class="mb-3">
                <label class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" name="c_np">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success" name="save">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="../js/jquery-3.5.1.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>

    <script>
      $(document).on('click', 'input[type="radio"]', function() {      
        $('input[type="radio"]').not(this).prop('checked', false);      
      });
      const navbar = document.querySelector(".col-navbar");
      const cover = document.querySelector(".screen-cover");

      const sidebar_items = document.querySelectorAll(".sidebar-item");

      function toggleNavbar() {
        navbar.classList.toggle("d-none");
        cover.classList.toggle("d-none");
      }
      
    </script>
  </body>
</html>
