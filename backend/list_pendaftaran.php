<?php
include 'koneksi.php';

$query = "SELECT p.id, p.nama_siswa, k.nama AS kelas_nama 
          FROM pendaftaran p
          JOIN kelas k ON p.kelas_id = k.id
          ORDER BY p.id DESC";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Daftar Pendaftar</title>
</head>
<body>
  <h2>Data Pendaftar Kelas</h2>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Nama Siswa</th>
      <th>Kelas</th>
      <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
  <td><?php echo $row['id']; ?></td>
  <td><?php echo htmlspecialchars($row['nama_siswa']); ?></td>
  <td><?php echo htmlspecialchars($row['kelas_nama']); ?></td>
  <td>
    <a href="hapus_pendaftaran.php?id=<?php echo $row['id']; ?>" 
       onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
  </td> <!-- Tambah kolom aksi ini -->
</tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
