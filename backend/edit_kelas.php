<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: kelas.php");
    exit;
}

$stmt = $koneksi->prepare("SELECT * FROM kelas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$kelas = $result->fetch_assoc();
if (!$kelas) {
    header("Location: kelas.php");
    exit;
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $kuota = trim($_POST['kuota']);

    // Validasi input
    if ($nama == '') $errors[] = 'Nama kelas wajib diisi.';
    if ($kuota == '' || !is_numeric($kuota) || $kuota < 1) $errors[] = 'Kuota harus berupa angka positif.';

    if (!$errors) {
        $stmt = $koneksi->prepare("UPDATE kelas SET nama = ?, kuota = ? WHERE id = ?");
        $stmt->bind_param("sii", $nama, $kuota, $id);
        if ($stmt->execute()) {
            header("Location: kelas.php");
            exit;
        } else {
            $errors[] = 'Gagal memperbarui data kelas.';
        }
    }
} else {
    $nama = $kelas['nama'];
    $kuota = $kelas['kuota'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Kelas</title>
</head>
<body>
<h1>Edit Kelas</h1>
<?php if ($errors): ?>
    <ul style="color:red;">
        <?php foreach ($errors as $error) echo "<li>$error</li>"; ?>
    </ul>
<?php endif; ?>
<form action="" method="post">
    <label>Nama Kelas:</label><br />
    <input type="text" name="nama" required value="<?= htmlspecialchars($nama) ?>"><br>
    <label>Kuota:</label><br />
    <input type="number" name="kuota" required min="1" value="<?= htmlspecialchars($kuota) ?>"><br><br>
    <input type="submit" value="Simpan Perubahan">
</form>
<p><a href="kelas.php">Kembali ke Daftar Kelas</a></p>
</body>
</html>
