<?php
include 'backend/koneksi.php'; // sesuaikan path jika perlu

$sql = "SELECT * FROM kelas ORDER BY id ASC";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>registrasi_by_Sopia - Daftar Kelas</title>
  <link rel="stylesheet" href="css/style.css" /> 
</head>
<body>
  <h1>Daftar Kelas</h1>
  <table border="1" cellpadding="5">
    <thead>
      <tr>
        <th>ID Kelas</th>
        <th>Nama Kelas</th>
        <th>Kuota</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($kelas = $result->fetch_assoc()) : ?>
      <tr>
        <td><?= $kelas['id'] ?></td>
        <td><?= htmlspecialchars($kelas['nama']) ?></td>
        <td><?= $kelas['kuota'] ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <p><a href="daftar.php">Daftar Kelas</a></p>
</body>
</html>
