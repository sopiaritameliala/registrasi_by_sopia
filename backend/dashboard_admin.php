<?php
session_start();
// Timeout session dalam detik (misal 15 menit)
$timeout_duration = 900;

// Cek apakah sudah ada waktu aktivitas sebelumnya dan hitung selisihnya
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php?timeout=1");
    exit;
}

// Update waktu aktivitas terakhir
$_SESSION['last_activity'] = time();

// Cek apakah sudah login admin
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// Query data kelas + hitung jumlah pendaftar per kelas
$sql = "SELECT kelas.id, kelas.nama, kelas.kuota, COUNT(pendaftaran.id) AS jumlah_pendaftar
        FROM kelas LEFT JOIN pendaftaran ON kelas.id = pendaftaran.kelas_id
        GROUP BY kelas.id, kelas.nama, kelas.kuota";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <p><a href="logout.php">Logout</a></p>
    <p><a href="list_pendaftaran.php">Lihat Data Pendaftar</a></p>
    <h1>Dashboard Statistik Pendaftar dan Kuota Kelas</h1>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Kuota</th>
                <th>Jumlah Pendaftar</th>
                <th>Sisa Kuota</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= $row['kuota'] ?></td>
                    <td><?= $row['jumlah_pendaftar'] ?></td>
                    <td><?= $row['kuota'] - $row['jumlah_pendaftar'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
