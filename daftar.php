<?php
include 'backend/koneksi.php';

// Ambil data kelas dari tabel kelas
$sql = "SELECT kelas.id, kelas.nama, kelas.kuota, 
    (kelas.kuota - COUNT(pendaftaran.id)) AS sisa_kuota
    FROM kelas LEFT JOIN pendaftaran ON kelas.id = pendaftaran.kelas_id
    GROUP BY kelas.id, kelas.nama, kelas.kuota
    ORDER BY kelas.nama ASC";
$result = $koneksi->query($sql);

$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $kelas_id = $_POST['kelas_id'] ?? '';

    // Cek validasi form
    if ($nama == '' || $kelas_id == '') {
        $error = "Semua kolom wajib diisi.";
    } else {
        // Cek kuota kelas
        $sqlCek = "SELECT kelas.kuota, COUNT(pendaftaran.id) AS jumlah
                    FROM kelas LEFT JOIN pendaftaran ON kelas.id = pendaftaran.kelas_id
                    WHERE kelas.id = ?
                    GROUP BY kelas.kuota";
        $stmt = $koneksi->prepare($sqlCek);
        $stmt->bind_param('i', $kelas_id);
        $stmt->execute();
        $resultCek = $stmt->get_result();
        $rowCek = $resultCek->fetch_assoc();

        if (!$rowCek || $rowCek['jumlah'] >= $rowCek['kuota']) {
            $error = "Kuota kelas sudah penuh.";
        } else {
            // Insert data pendaftaran
            $sqlInsert = "INSERT INTO pendaftaran (nama_siswa, kelas_id) VALUES (?, ?)";
            $stmt = $koneksi->prepare($sqlInsert);
            $stmt->bind_param('si', $nama, $kelas_id);
            if ($stmt->execute()) {
                $success = "Pendaftaran berhasil! Terima kasih, " . htmlspecialchars($nama) . ".";
            } else {
                $error = "Pendaftaran gagal. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>registrasi_by_Sopia - Form Pendaftaran</title>
  <link rel="stylesheet" href="css/style.css" /> 
</head>
<body>
  <h1>Form Pendaftaran Kelas</h1>

  <?php if ($error): ?>
    <p style="color:red;"><?= $error ?></p>
  <?php elseif ($success): ?>
    <p style="color:green;"><?= $success ?></p>
  <?php endif; ?>

  <form action="" method="POST">
    <p>
      <label>Nama Lengkap:</label>
      <input type="text" name="nama" placeholder="Masukkan nama lengkap" required />
    </p>
    <p>
      <label>Pilih Kelas:</label>
      <select name="kelas_id" required>
        <option value="">-- Pilih Kelas --</option>
        <?php
        // Query ulang kelas untuk dropdown
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()):
        ?>
          <option value="<?= $row['id'] ?>">
            <?= htmlspecialchars($row['nama']) ?> (Sisa kuota: <?= $row['sisa_kuota'] ?>)
          </option>
        <?php endwhile; ?>
      </select>
    </p>
    <p>
      <button type="submit">Daftar</button>
    </p>
  </form>
  <p><a href="index.php">Kembali ke Daftar Kelas</a></p>
</body>
</html>
