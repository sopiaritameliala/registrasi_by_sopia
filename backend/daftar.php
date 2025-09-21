<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kelas_id = intval($_POST['kelas_id']);

    // Cek kuota kelas
    $kuota_result = mysqli_query($koneksi, "SELECT kuota FROM kelas WHERE id=$kelas_id");
    $kuota = mysqli_fetch_assoc($kuota_result)['kuota'];

    $jumlah_pendaftar_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pendaftaran WHERE kelas_id=$kelas_id");
    $jumlah_pendaftar = mysqli_fetch_assoc($jumlah_pendaftar_result)['total'];

    if ($jumlah_pendaftar < $kuota) {
        // Masukkan data pendaftaran
        $insert = mysqli_query($koneksi, "INSERT INTO pendaftaran (nama_siswa, kelas_id) VALUES ('$nama', $kelas_id)");
        if ($insert) {
            echo "Pendaftaran berhasil!";
        } else {
            echo "Gagal mendaftar: " . mysqli_error($koneksi);
        }
    } else {
        echo "Kuota kelas sudah penuh!";
    }
} else {
    echo "Metode request tidak diperbolehkan";
}
?>
