<?php 
session_start();
if(!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'functions.php';

$countUser = query("SELECT count(*) as countAll FROM users")[0];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="./css/index.css" />

    <title>Dashboard - KPP Pajak</title>
  </head>

  <body>
    <div class="screen-cover d-none d-xl-none"></div>

    <div class="row">
      <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">
        <aside class="sidebar">
          <a href="#" class="sidebar-logo">
            <div class="d-flex justify-content-start align-items-center">
              <img
                src="./assets/img/global/logo.png"
                alt=""
                style="width: 1.5rem"
              />
              <span>KPP Pratama</span>
            </div>

            <button id="toggle-navbar" onclick="toggleNavbar()">
              <img src="./assets/img/global/navbar-times.svg" alt="" />
            </button>
          </a>

          <h5 class="sidebar-title">Sering Digunakan</h5>

          <a
            href="index.php"
            class="sidebar-item active"
          >
            <!-- <img src="./assets/img/global/grid.svg" alt=""> -->

            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M21 14H14V21H21V14Z"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 14H3V21H10V14Z"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M21 3H14V10H21V3Z"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <path
                d="M10 3H3V10H10V3Z"
                stroke="white"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>

            <span>Dashboard</span>
          </a>

          <!-- <a href="./employees.html" class="sidebar-item"> -->
          <!-- <img src="./assets/img/global/users.svg" alt=""> -->
          <a href="suratkeluar/index.php" class="sidebar-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-slash" viewBox="0 0 16 16">
              <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
              <path d="M14.975 10.025a3.5 3.5 0 1 0-4.95 4.95 3.5 3.5 0 0 0 4.95-4.95Zm-4.243.707a2.501 2.501 0 0 1 3.147-.318l-3.465 3.465a2.501 2.501 0 0 1 .318-3.147Zm.39 3.854 3.464-3.465a2.501 2.501 0 0 1-3.465 3.465Z"/>
            </svg>

            <span>Surat Keluar</span>
          </a>
          
          <a href="../kpp-pajak/login.php" class="sidebar-item">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-slash" viewBox="0 0 16 16">
              <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z"/>
              <path d="M14.975 10.025a3.5 3.5 0 1 0-4.95 4.95 3.5 3.5 0 0 0 4.95-4.95Zm-4.243.707a2.501 2.501 0 0 1 3.147-.318l-3.465 3.465a2.501 2.501 0 0 1 .318-3.147Zm.39 3.854 3.464-3.465a2.501 2.501 0 0 1-3.465 3.465Z"/>
            </svg>

            <span>Lebih Bayar</span>
          </a>

          <h5 class="sidebar-title">Lainnya</h5>

          <a href="logout.php" class="sidebar-item">
            <!-- <img src="./assets/img/global/log-out.svg" alt=""> -->

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
                <img src="./assets/img/global/burger.svg" class="mb-2" alt="" />
              </button>
              <h2 class="nav-title">Dashboard</h2>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center nav-input-container">
            <div class="dropdown">
              <button class="btn-notif d-none d-md-flex flex-nowrap" type="button" id="user-detail" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="./assets/img/home/history/photo-1.png" alt="" class="me-2">
                <?php echo $fetch["nama"]; ?>
              </button>
              <ul class="dropdown-menu" aria-labelledby="user-detail">
                <li><a class="dropdown-item" href="logout.php"><img src="assets/img/global/log-out.svg" alt="logout" class="me-2"> Logout</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="content">
          <div class="row">
            <h4>Data Tidak Ada!</h4>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script>

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
