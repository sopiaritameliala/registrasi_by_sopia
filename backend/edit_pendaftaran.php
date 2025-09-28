<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID pendaftar tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);

// Ambil data pendaftar berdasarkan id
$query = "SELECT p.*, k.nama AS kelas_nama FROM pendaftaran p JOIN kelas k ON p.kelas_id = k.id WHERE p.id = $id";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) == 0) {
    echo "Data pendaftar tidak ditemukan.";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Ambil semua kelas untuk form select pilihan kelas
$kelas_result = mysqli_query($koneksi, "SELECT * FROM kelas");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Pendaftaran</title>
</head>
<body>
  <h2>Edit Data Pendaftar</h2>
  <form method="POST" action="update_pendaftaran.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    
    <label for="nama">Nama:</label><br />
    <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama_siswa']); ?>" required /><br /><br />
    
    <label for="kelas_id">Pilih Kelas:</label><br />
    <select id="kelas_id" name="kelas_id" required>
      <?php while ($k = mysqli_fetch_assoc($kelas_result)) : ?>
        <option value="<?php echo $k['id']; ?>" <?php if ($k['id'] == $row['kelas_id']) echo 'selected'; ?>>
          <?php echo htmlspecialchars($k['nama']); ?>
        </option>
      <?php endwhile; ?>
    </select><br /><br />
    
    <button type="submit">Update</button>
  </form>
</body>
</html>
