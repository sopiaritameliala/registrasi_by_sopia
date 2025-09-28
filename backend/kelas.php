<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$sql = "SELECT * FROM kelas ORDER BY id ASC";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Manajemen Kelas</title>
</head>
<body>
<h1>Manajemen Kelas</h1>
<p><a href="dashboard_admin.php">Dashboard</a> | <a href="tambah_kelas.php">Tambah Kelas Baru</a> | <a href="logout.php">Logout</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kelas</th>
            <th>Kuota</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($kelas = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $kelas['id'] ?></td>
                <td><?= htmlspecialchars($kelas['nama']) ?></td>
                <td><?= $kelas['kuota'] ?></td>
                <td>
                    <a href="edit_kelas.php?id=<?= $kelas['id'] ?>">Edit</a> | 
                    <a href="hapus_kelas.php?id=<?= $kelas['id'] ?>" onclick="return confirm('Yakin ingin hapus kelas ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
