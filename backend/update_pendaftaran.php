<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas_id = intval($_POST['kelas_id']);

    // Update data pendaftar
    $sql = "UPDATE pendaftaran SET nama_siswa = '$nama', kelas_id = $kelas_id WHERE id = $id";
    if (mysqli_query($koneksi, $sql)) {
        header("Location: list_pendaftaran.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($koneksi);
    }
} else {
    echo "Metode tidak diperbolehkan";
}
?>
