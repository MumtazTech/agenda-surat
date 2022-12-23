<?php
require '../functions.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=DataSuratKeluar.xls");

$suratkeluar = query("SELECT * FROM suratkeluar, users WHERE suratkeluar.nip = users.nip ORDER BY id DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ekspor Data</title>
</head>
<body>
  <h3>Daftar Surat Keluar</h3>
  <table border="1" cellpadding="10" cellspacing="0" id="table">
    <thead>
      <th>No</th>
      <th>Tanggal Surat</th>
      <th>Format</th>
      <th>Nama</th>
      <th>Keterangan</th>
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
          </tr>
          <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
</body>
</html>