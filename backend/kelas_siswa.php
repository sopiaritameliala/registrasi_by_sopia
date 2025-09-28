<?php
include 'backend/koneksi.php';

// Query kelas beserta hitung sisa kuota (kuota dikurangi jumlah pendaftar)
$sql = "SELECT kelas.id, kelas.nama, kelas.kuota, 
        (kelas.kuota - COUNT(pendaftaran.id)) AS sisa_kuota
        FROM kelas LEFT JOIN pendaftaran ON kelas.id = pendaftaran.kelas_id
        GROUP BY kelas.id, kelas.nama, kelas.kuota";
$result = $koneksi->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Daftar Kelas untuk Siswa</title>
</head>
<body>
<h1>Daftar Kelas dan Sisa Kuota</h1>
<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>Nama Kelas</th>
            <th>Kuota</th>
            <th>Sisa Kuota</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($kelas = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= htmlspecialchars($kelas['nama']) ?></td>
                <td><?= $kelas['kuota'] ?></td>
                <td><?= $kelas['sisa_kuota'] ?></td>
                <td>
                    <?php if ($kelas['sisa_kuota'] > 0): ?>
                        <a href="daftar.php?kelas_id=<?= $kelas['id'] ?>">Daftar</a>
                    <?php else: ?>
                        Penuh
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
