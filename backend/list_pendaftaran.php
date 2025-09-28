<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
session_start();

// Timeout session dalam detik, contoh 15 menit = 900 detik
$timeout_duration = 900;

// Cek apakah waktu aktivitas sebelumnya sudah lebih dari durasi timeout
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

$sql = "SELECT pendaftaran.id, pendaftaran.nama_siswa, kelas.nama 
        FROM pendaftaran 
        JOIN kelas ON pendaftaran.kelas_id = kelas.id
        ORDER BY pendaftaran.id DESC";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Data Pendaftar Kelas</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <p><a href="dashboard_admin.php">Dashboard Admin</a></p>
    <h1>Data Pendaftar Kelas</h1>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['nama_siswa']) ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>
                    <a href="edit_pendaftaran.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="hapus_pendaftaran.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus data?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
