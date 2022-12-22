<?php
$conn = mysqli_connect("localhost:3308", "root", "", "agendasurat");

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
  }

  return $rows;
}

function tambahSuratKeluar($data) {
  global $conn;

  $tgl_surat = $data["tgl_surat"] ?? NULL;
  $nip = $_SESSION["nip"] ?? NULL;
  $s = $data["s"] ?? 0;
  $kep = $data["kep"] ?? 0;
  $sp = $data["sp"] ?? 0;
  $up = $data["up"] ?? 0;
  $ba = $data["ba"] ?? 0;
  $nd = $data["nd"] ?? 0;
  $pbkm = $data["pbk_m"] ?? 0;
  $verbal = $data["verbal"] ?? 0;
  $lhpt = $data["lhpt"] ?? 0;
  $keterangan = htmlspecialchars($data["keterangan"]) ?? NULL;

  mysqli_query($conn, "INSERT INTO suratkeluar (tgl_surat, nip, s, kep, sp, up, ba, nd, pbk_m, verbal, lhpt, keterangan) VALUES ('$tgl_surat', '$nip', '$s', '$kep', '$sp', '$up', '$ba', '$nd', '$pbkm', '$verbal', '$lhpt', '$keterangan')");
  return mysqli_affected_rows($conn);
}

function editSuratKeluar($data) {
  global $conn;

  $id = $data["id"];
  $tgl_surat = $data["tgl_surat"] ?? NULL;
  $keterangan = htmlspecialchars($data["keterangan"]) ?? NULL;

  mysqli_query($conn, "UPDATE suratkeluar SET tgl_surat = '$tgl_surat', keterangan = '$keterangan' WHERE id = $id");
  return mysqli_affected_rows($conn);
}

function register($data) {
  global $conn;
  
  $nip = htmlspecialchars($data["nip"]);
  $nama = htmlspecialchars($data["nama"]);
  $password = mysqli_real_escape_string($conn, htmlspecialchars($data["password"]));
  $password2 = mysqli_real_escape_string($conn, htmlspecialchars($data["password2"]));

  $userExist = mysqli_query($conn, "SELECT nama FROM users WHERE nama = '$nama'");
  $nipExist = mysqli_query($conn, "SELECT nip FROM users WHERE nip = '$nip'");

  if(mysqli_fetch_assoc($nipExist)) {
    echo "
      <script>
        alert('NIP sudah terdaftar!');
      </script>
    ";
    return false;
  }

  if(mysqli_fetch_assoc($userExist)) {
    echo "
      <script>
        alert('Admin sudah terdaftar!');
      </script>
    ";
    return false;
  }

  if($password !== $password2) {
    echo "
      <script>
        alert('Konfirmasi password tidak sesuai!');
      </script>
    ";
    return false;
  }

  $password = password_hash($password, PASSWORD_DEFAULT);
  mysqli_query($conn, "INSERT INTO users VALUES ('', '$nip', '$nama', '$password')");

  return mysqli_affected_rows($conn);
}
