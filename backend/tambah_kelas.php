<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $kuota = trim($_POST['kuota']);

    // Validasi input
    if ($nama == '') {
        $errors[] = 'Nama kelas wajib diisi.';
    }
    if ($kuota == '' || !is_numeric($kuota) || $kuota < 1) {
        $errors[] = 'Kuota harus berupa angka positif.';
    }

    if (!$errors) {
        $stmt = $koneksi->prepare("INSERT INTO kelas (nama, kuota) VALUES (?, ?)");
        $stmt->bind_param("si", $nama, $kuota);
        if ($stmt->execute()) {
            header("Location: kelas.php");
            exit;
        } else {
            $errors[] = 'Gagal menambah data kelas.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Tambah Kelas Baru</title>
</head>
<body>
<h1>Tambah Kelas Baru</h1>
<?php if ($errors): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $error) echo "<li>$error</li>"; ?>
    </ul>
<?php endif; ?>
<form action="" method="post">
    <label>Nama Kelas:</label><br />
    <input type="text" name="nama" required value="<?= isset($nama) ? htmlspecialchars($nama) : '' ?>"><br>
    <label>Kuota:</label><br />
    <input type="number" name="kuota" required min="1" value="<?= isset($kuota) ? htmlspecialchars($kuota) : '' ?>"><br><br>
    <input type="submit" value="Tambah Kelas">
</form>
<p><a href="kelas.php">Kembali ke Daftar Kelas</a></p>
</body>
</html>
