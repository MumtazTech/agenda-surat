<?php 
session_start();
if(!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}
require '../functions.php';

$suratkeluar = query("SELECT * FROM suratkeluar, users WHERE suratkeluar.nip = users.nip ORDER BY id DESC");
$getNama = query("SELECT * FROM suratkeluar, users WHERE suratkeluar.nip = users.nip AND users.nip = " . $_SESSION["nip"])[0];

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

    <!-- DataTables -->
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="../css/index.css" />

    <title>Daftar Surat Keluar - KPP Pajak</title>
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



          <!-- <a href="../employees.html" class="sidebar-item"> -->
          <!-- <img src="../assets/img/global/users.svg" alt=""> -->
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
              <h2 class="nav-title">Daftar Surat Keluar</h2>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center nav-input-container">
            <div class="dropdown">
              <button class="btn-notif d-none d-md-flex flex-nowrap text-capitalize" type="button" id="user-detail" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../assets/img/home/history/photo-1.png" alt="" class="me-2">
                <?php echo $getNama["nama"]; ?>
              </button>
              <ul class="dropdown-menu" aria-labelledby="user-detail">
                <li><a class="dropdown-item" href="../logout.php"><img src="../assets/img/global/log-out.svg" alt="logout" class="me-2"> Logout</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="content">
          <div class="row">
            <div class="col-12">
              <div class="statistics-card">
                <a href="tambah.php" class="btn mb-4" style="background-color: #fcc100 !important; color:white;">
                  Tambah Surat Keluar <img src="../assets/img/global/times.svg" class="ml-3" alt="" />
                </a>
                <table border="1" cellpadding="10" cellspacing="0" class="table table-striped table-hover rounded" id="table">
                  <thead>
                    <th>No</th>
                    <th>Tanggal Surat</th>
                    <th>Format</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Edit</th>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                      <?php foreach($suratkeluar as $row) : ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row["tgl_surat"]; ?></td>
                          <td>
                            <?php
                              if($row["s"] != 0) {
                                echo "S-" . $row["s"] ."/KPP.320703/2022";
                              }
                              else if($row["kep"] != 0) {
                                echo "KEP-" . $row["kep"] ."/KPP.320703/2022";
                              }
                              else if($row["up"] != 0) {
                                echo "UP-" . $row["up"] ."/KPP.320703/2022";
                              }
                              else if($row["ba"] != 0) {
                                echo "BA-" . $row["ba"] ."/KPP.320703/2022";
                              }
                              else if($row["nd"] != 0) {
                                echo "ND-" . $row["nd"] ."/KPP.320703/2022";
                              }
                              else if($row["pbk_m"] != 0) {
                                echo "PBKM-" . $row["pbk_m"] ."/KPP.320703/2022";
                              }
                              else if($row["verbal"] != 0) {
                                echo "V-" . $row["verbal"] ."/KPP.320703/2022";
                              }
                              else if($row["lhpt"] != 0) {
                                echo "LHPt-" . $row["lhpt"] ."/KPP.320703/2022";
                              }
                            ?>
                          </td>
                          <td><?php echo $row["nama"]; ?></td>
                          <td><?php echo $row["keterangan"]; ?></td>
                          <?php if($_SESSION["nip"] == $row["nip"]) : ?>
                            <td>
                              <a href="ubah.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary">Edit</a>
                            </td>
                          <?php else : ?>
                            <td>Hanya <?php echo $row["nama"]; ?> yang dapat mengedit</td>
                          <?php endif; ?>
                        </tr>
                        <?php $i++; ?>
                      <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="../js/jquery-3.5.1.js"></script>
    <script
      src="../js/bootstrap.bundle.min.js"
    ></script>
    <script src="../js/jquery.dataTables.min.js"></script>

    <script>
      $(document).ready(function () {
        $('#table').DataTable({
          responsive: true,
          "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Data belum dibuat",
            "infoFiltered": "(dicari dari _MAX_ total data)"
          },
        });
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
